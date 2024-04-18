<?php

namespace Stepsoft\Soffice8sdk\SOffice8;

use Stepsoft\Soffice8sdk\SOffice8\Errors\RequestUnauthorized;
use Stepsoft\Soffice8sdk\SOffice8\Errors\RequestNotAcceptable;
use Stepsoft\Soffice8sdk\SOffice8\Errors\ResponseError;
use Stepsoft\Soffice8sdk\SOfficeRequest as Client;

class BaseAPI
{

    public $client;

    /**
     * Importing the SOffice Client Request class with predefined domain name.
     * @param Client $client
     */
    public function __construct(Client $client, $version = null)
    {
        
        $this->client = $client;
       
    }

    /**
     * Function that validates the response and manage some of 
     * the default content returned from the server
     * @param type $response
     * @return string
     */
    protected function validate($response)
    {
        if(!isset($response['status_code'])){
            $response['status_code'] = 200;
        }
        if (in_array($response['status_code'], array(200))) {
            $response['status'] = 'message';
            return $response;
        }
        if (in_array($response['status_code'], array(201, 202, 204))) {
            $response['status'] = 'success';
            return $response;
        }
        if (in_array(($response['status_code'] ?? 0), array(409, 400, 403))) {
            $response['status'] = 'error';
            return $response;
        }
        if (in_array($response['status_code'], array(404, 423, 499))) {
            $response['status'] = 'error';
            throw new ResponseError('Error in response:' . $response['status_code']);
        }

        //unauthorized
        if (in_array($response['status_code'], array(401))) {
            throw new RequestUnauthorized($response['message']);
        }

        if (in_array($response['status_code'], array(401))) {
            $response['status'] = 'error';
            return $response;
        }

        //request not acceptable (invalid data)
        if (in_array($response['status_code'], array(406))) {
            throw new RequestNotAcceptable($response['message']);
        }

        if (in_array($response['status_code'], array(406))) {
            $response['status'] = 'error';
            return $response;
        }

        if (in_array($response['status_code'], array(500))) {
            $response['status'] = 'error';
            return $response;
        }
        //TO DO
        return $response;
    }

    

    /**
     * Add params to given uri and return modified uri string
     * @param type $uri
     * @param type $params
     * @return string
     */
    protected function addParams($uri, $params)
    {
        return $uri . '?' . http_build_query($params);
    }

}
