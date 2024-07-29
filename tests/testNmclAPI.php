<?php

use Stepsoft\Soffice8sdk\SOffice8\NmclAPI;
use Stepsoft\Soffice8sdk\SOfficeRequest;

test('Test NmclAPI', function () {
    
    //Replace Token with your own
    $client = new SOfficeRequest(
        'http://192.168.0.106:8081/', 
        //'https://soffice8api.stepsoft.bg/', 
        'v1', 
        'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJwYXNrb0BzdGVwc29mdC5iZyIsInN1YiI6IkFQSSIsImRhdGFiYXNlIjoiU09mZmljZThfU19EZXZlbG9wZXJOZXciLCJleHAiOjE3MjIwMTUxMTYuMDg3Mzk5fQ.lU_QKpQHKQqLiGUUiqFgUOvb_flUg--4vUeXFpX754c');
    
    $testNmclAPIRequest = new NmclAPI($client);

    $response = $testNmclAPIRequest->getNmclRange(
        17,
        5667,
        5767,
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