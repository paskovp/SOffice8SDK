<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Stepsoft\Soffice8sdk\SOffice8\Errors;

use Exception;

/**
 * Description of 406
 *
 * @author plamen
 */
class RequestError extends Exception
{
    //put your code here
    public $message;
    public $response;

    public function __construct($message, $response = null)
    {
        $this->message = $message;
        $this->response = $response;
    }
}
