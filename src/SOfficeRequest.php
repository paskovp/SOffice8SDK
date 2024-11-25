<?php

namespace Stepsoft\Soffice8sdk;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Stepsoft\Soffice8sdk\SOffice8\Errors\RequestError;

class SOfficeRequest
{
    public $curl;
    public $sendRequestTo;
    private $url;
    public $jwt_token;
    protected $getParams = '';
    public $version;

    public function __construct(string $sendRequestTo, $version = "v1", $jwt_token = NULL)
    {
        $this->setRequestTo($sendRequestTo);
        $this->version = $version;
        $this->jwt_token = $jwt_token;

        $ip = $this->getIp();
        $userAgent = $this->getUserAgent();
        $this->curl = curl_init();

        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLINFO_HEADER_OUT, true);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->curl, CURLOPT_VERBOSE, true);

        //try to autoclose curl connection
        curl_setopt($this->curl, CURLOPT_FORBID_REUSE, true);

        $curl_setopt_arr = array(
            'Connection: close',
            'requestip: ' . $ip,
            'userAgent: ' . $userAgent,
        );
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $curl_setopt_arr);

        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);

        return $this->curl;
    }

    public function getIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = 'IP not detected'; 
        }

        return $ip;
    }
    
    public function getUserAgent()
    {
        $userAgent = 'UserAgent not detected';

        if (!empty($_SERVER['HTTP_USER_AGENT']))
        {
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
        }

        return $userAgent;
    }

    public function setRequestTo($sendRequestTo)
    {
        return $this->sendRequestTo = $sendRequestTo;
    }

    public function getRequstTo(): string
    {
        return $this->sendRequestTo;
    }

    public function setUri(string $uri)
    {
        if (str_contains($uri, 'http')) {
            $this->url = $uri;
            return curl_setopt($this->curl, CURLOPT_URL, $this->url);
        }

        if ($uri[0] == '/') {
            $uri = substr($uri, 1);
        }
        $this->url = $this->getRequstTo() . $uri . $this->getParams;
        
        //Temporary fix for double question mark in url
        $this->url = str_replace('??','?',$this->url);

        return curl_setopt($this->curl, CURLOPT_URL, $this->url);
    }

    public function post($data)
    {
        curl_setopt($this->curl, CURLOPT_POST, TRUE);
        // if ($_FILES) {
        //     //            curl_setopt($this->curl, CURLOPT_UPLOAD, TRUE);
        //     if (str_contains($this->controller_name, 'ImportController')) {
        //         $fileArr = [];

        //         $temporaryUploadPath = public_path() . DIRECTORY_SEPARATOR . 'importUploads' . DIRECTORY_SEPARATOR . str_random(10);
        //         session()->push('temporaryImportUploadPath', $temporaryUploadPath);
        //         foreach ($this->request->file() as $file) {
        //             $filename = $file->getClientOriginalName();

        //             //                    $newFileName = str_random(5) . '.' . $file->getClientOriginalExtension();
        //             $newFileName = CyrillicToLatin::cyrillicToLatin($filename);
        //             $mimeType = $file->getMimeType();
        //             $file->move($temporaryUploadPath, $newFileName);
        //             $fileArr[] = new \CURLFile(
        //                 $temporaryUploadPath . DIRECTORY_SEPARATOR . $newFileName,
        //                 $mimeType,
        //                 $filename
        //             );
        //             //                    $fileArr[] =  curl_file_create(
        //             //                            $temporaryUploadPath . DIRECTORY_SEPARATOR . $filename
        //             //                            , $mimeType
        //             //                            , basename($temporaryUploadPath . DIRECTORY_SEPARATOR . $filename)
        //             //                        );
        //         }
        //         $data['file_contents'] = $fileArr;
        //         curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
        //             'Content-Type: multipart/form-data',
        //         ));
        //         return curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->flatten($data));
        //     }
        //     return $this->addFiles($data);
        // }
        return curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->flatten($data));
    }

    public function get($data)
    {
        if ($data) {
            $this->getParams = '?' . http_build_query($this->flatten($data));
            return true;
        }
        return true; 
    }

    /**
     * Transform multidimensional array to one dimension that need to be submitted over curl
     * @param array $array
     * @return array
     */
    public function flatten(array $array)
    {
        if (empty($array)) {
            return [];
        }
        // if(\Session::get('autoserver') == true){
        //     $data = self::preparedata(['autocompleteData' => $array]);
        // }else{
            $data = self::preparedata(['data' => $array]);
        // }

        foreach ($data as $key => $value) {
            $newKey = $this->str_replace_first(']', '', $key) . ']';
            unset($data[$key]);
            $data[$newKey] = $value;
        }

        return $data;
    }

    /**
     * Recursive method like a laravel array_dot helper.
     * This method transforms a multidimensional array to one dimension with keys separated by ][
     * @param array $array
     * @param string $prepend
     */
    protected static function preparedata(array $array, $prepend = ''): array
    {
        $results = [];
        foreach ($array as $key => $value) {
            if (is_array($value) && !empty($value)) {
                $results = array_merge($results, static::preparedata($value, $prepend . $key . ']['));
            } else {
                $results[$prepend . $key] = $value;
            }
        }
        return $results;
    }

    // protected function addFiles($data)
    // {
    //     $allFiles = Request::file();

    //     //Transform form data to flat array. Curl need one dimension array to submit it
    //     $post = $this->flatten($data);
    //     $temporaryUploadPath = public_path() . DIRECTORY_SEPARATOR . 'tempUploads' . DIRECTORY_SEPARATOR . str_random(10);
    //     //Caching the temp folder where the files will be moved,
    //     //and deleted after the response from the server
    //     \Session::put('temporaryUploadPath', $temporaryUploadPath);
    //     foreach ($allFiles as $tableName => $files) {
    //         //multiple file upload
    //         if (is_array($files)) {
    //             foreach ($files as $id_section => $file) {
    //                 //upload file from document title
    //                 if ($file instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
    //                     curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
    //                         'Content-Type: multipart/form-data',
    //                     ));

    //                     $filename = $file->getClientOriginalName();
    //                     $mimeType = $file->getMimeType();
                        
    //                     $file->move($temporaryUploadPath, $filename);

    //                     $post['files[' . $id_section . '][0]'] = curl_file_create($temporaryUploadPath . '/' . $filename, $mimeType, basename($temporaryUploadPath . '/' . $filename)); //
    //                 } else {
    //                     //chech if file is selected
    //                     if (!$file) {
    //                         continue;
    //                     }

    //                     //upload file from document rows
    //                     foreach ($file as $id_grid_row => $fileColumn) {
    //                         foreach ($fileColumn as $file_name => $f) {
    //                             if ($f instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
    //                                 curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
    //                                     'Content-Type: multipart/form-data',
    //                                 ));
    //                                 $filename = $f->getClientOriginalName();
    //                                 $mimeType = $f->getMimeType();
    //                                 $f->move($temporaryUploadPath, $filename);

    //                                 $post['files[' . $id_section . '][' . $id_grid_row . '][' . $file_name . '][]'] = curl_file_create($temporaryUploadPath . '/' . $filename, $mimeType, basename($temporaryUploadPath . '/' . $filename));
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //         } else {
    //             //single file upload like avatar
    //             if ($files instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
    //                 $filename = $files->getClientOriginalName();
    //                 $mimeType = $files->getMimeType();
    //                 $files->move($temporaryUploadPath, $filename);
    //                 $post['files[0][0]'] = curl_file_create($temporaryUploadPath . '/' . $filename, $mimeType, basename($temporaryUploadPath . '/' . $filename));
    //             }
    //         }
    //     }
    //     curl_setopt(
    //         $this->curl,
    //         CURLOPT_HTTPHEADER,
    //         array(
    //             'Content-Type: multipart/form-data',
    //         )
    //     );
    //     return curl_setopt($this->curl, CURLOPT_POSTFIELDS, $post);
    // }

    /**
     * @throws RequestError
     */
    public function sendRequest(string $uri, string $method, array $data)
    {
        $jwt_token = 'jwt_token NOT SET';
        
        if (!empty($this->jwt_token)) {
            $data['jwt_token'] = $this->jwt_token;
        }

        if (!method_exists($this, $method)) {
            throw new RequestError("method [$method] not exists");
        }

        //var_dump($data);

        $this->$method($data);
        $this->setUri($uri);

        // if (\AuthUserSOffice::user()) {
        //     curl_setopt($this->curl, CURLOPT_COOKIE, "laravel_session=" . \AuthUserSOffice::getUserToken() . ";");
        // }

        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1); //novo zaradi iztichaneto na sesiqta na survura
        curl_setopt($this->curl, CURLOPT_HEADER, 1); //novo zaradi iztichaneto na sesiqta na survura
        $response = curl_exec($this->curl);
        // curl_close($this->curl);
        $header_size = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE); //novo zaradi iztichaneto na sesiqta na survura
        $header = substr($response, 0, $header_size); //novo zaradi iztichaneto na sesiqta na survura
        
        $response = substr($response, $header_size);
        // Check the content type from headers
        if (strpos($header, 'application/json') !== false) {

            $jsonResponse = json_decode($response, true);

            return $jsonResponse;
            
        } else {
            // This is a file response.
            $fileType = '';  // Determine file type from $header if necessary
            $fileName = 'Файл';  // Default file name
            return [
                'jwt_token' => $jwt_token,
                'content' => $response,
                'type' => $fileType,
                'name' => $fileName
            ];
        }

        throw new RequestError('Internal server error');
    }

    public function sendLoginRequest(string $uri, string $method, array $data = [])
    {
        $this->$method($data);

        $this->setUri($uri);

        // echo "<pre>";
        // print_r($method);
        // echo "</pre>";

        // echo "<pre>";
        // print_r($this->url);
        // echo "</pre>";

        // echo "<pre>";
        // print_r($this->flatten($data));
        // echo "</pre>";
        // die;


        curl_setopt($this->curl, CURLOPT_HEADER, 1);

        $response = curl_exec($this->curl);

        try {
            list($header, $body) = explode("Content-Type: application/json", trim($response), 2);
            $jsonResponse = json_decode($body, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return ['header' => $header, 'jsonResponse' => $jsonResponse];
            }
        } catch (\Exception $e) {         
            throw new RequestError('Exception in sendLoginRequest');
        }
            
        throw new RequestError('Internal server error');
    }

    // private function responseDecrypt($jsonResponse)
    // {
    //     try {
    //         return Crypt::decrypt($jsonResponse);
    //     } catch (DecryptException $e) {
    //         return $jsonResponse;
    //     }
    // }

    public function fastSendRequest($url, $method, array $data = [])
    {
        return $this->sendRequest($url, $method, $data);
    }

    private function str_replace_first($search, $replace, $subject)
    {
        $search = (string) $search;

        if ($search === '') {
            return $subject;
        }

        $position = strpos($subject, $search);

        if ($position !== false) {
            return substr_replace($subject, $replace, $position, strlen($search));
        }

        return $subject;
    }

}
