<?php

use Stepsoft\Soffice8sdk\SOffice8\NmclAPI;
use Stepsoft\Soffice8sdk\SOfficeRequest;

test('Test NmclAPI', function () {
    
    //Replace Token with your own
    $client = new SOfficeRequest(
        //'http://192.168.0.106:8081/', 
        'https://soffice8api.stepsoft.bg/', 
        'v1', 
        'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJwYXNrb0BzdGVwc29mdC5iZyIsInN1YiI6IkFQSSIsImRhdGFiYXNlIjoiU09mZmljZThfU19EZXZlbG9wZXJOZXciLCJleHAiOjE3MjE5ODM1MjcuOTg1NDYxfQ.pCkWJrvpSKY0_SfHduA_Op5Rcpwg9lWtuIKm4i4EjI8');
    
    $testNmclAPIRequest = new NmclAPI($client);

    $response = $testNmclAPIRequest->getNmclRange(
        17,
        30346,
        30355,
        //27,
        //10,
        //100,
        '',
        '',
        '',
        ''
    );

    //var_dump($response);

    // Ensure that the response is an object
    expect($response)->toBeArray();
    // Ensure that the status code is 200
    expect($response['status_code'])->toBe(200);
});