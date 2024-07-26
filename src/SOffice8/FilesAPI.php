<?php

namespace Stepsoft\Soffice8sdk\SOffice8;

use Stepsoft\Soffice8sdk\SOfficeRequest as Client;

class FilesAPI extends BaseAPI {

    /**
     * Importing the SOffice Client Request classwith predefined domain name.
     * @param Client $client
     */
    public function __construct(Client $client) {
        parent::__construct($client);
    }

    /**
     * Sends a request to the server to retrieve a file for download
     * @param type $objectType
     * @param type $id_object
     * @param type $id_row
     * @param type $file_name
     * @return type
     */
    public function downloadFile(string $file_name, $origin) {
        $file_name = base64_encode($file_name);
        $response = $this->client->sendRequest('file/' . $file_name . '/' . $origin, 'GET');
        return $this->validate($response);
    }

    /**
     * Sends a request to the server to delete a file
     * @param type $objectType
     * @param type $id_object
     * @param type $id_row
     * @param type $file_name
     * @return type
     */
    public function deleteFile($file_name,$form_id,$section_id,$origin,$internal_num,$gridElType = null) {
        $response = $this->client->sendRequest('file/' . $file_name . '/' . $form_id . '/' . $section_id . '/' . $origin . '/' . $internal_num . '/' . $gridElType, 'POST');
        return $this->validate($response);
    }

}
