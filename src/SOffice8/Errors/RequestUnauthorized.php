<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Stepsoft\Soffice8sdk\SOffice8\Errors;

use Exception;

/**
 * Error when request is not authorized
 *
 * @author plamen
 */
class RequestUnauthorized extends Exception {
    
    public $message;
    
    public function __construct($message) {
        $this->message = $message;
    }
}
