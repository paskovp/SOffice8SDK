<?php

use Stepsoft\Soffice8sdk\SOffice8\NmclAPI;
use Stepsoft\Soffice8sdk\SOfficeRequest;

test('Test NmclAPI', function () {
    
    //Replace Token with your own
    $client = new SOfficeRequest(
        //'http://192.168.0.106:8081/', 
        'https://soffice8api.stepsoft.bg/', 
        'v1', 
        'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJzdXBwb3J0QHN0ZXBzb2Z0LmJnIiwic3ViIjoiQVBJIiwiZGF0YWJhc2UiOiJTT2ZmaWNlOF9NYWdudW1DeXBydXMiLCJleHAiOjE3Mjg0MTE2MzYuMzY2MTM0fQ.biag21dD-QujsN43-1Syxif2B9Y7q5G7d7e97r8TCok');
    
    $testNmclAPIRequest = new NmclAPI($client);

    $response = $testNmclAPIRequest->getNmclRange(
        17,
        '',
        '',
        //27,
        //10,
        //100,
        '',
        '',
        '',
        '',
        '2024-10-08 04:03:55.000', 
        false
    );

    //var_dump($response);

    // Ensure that the response is an object
    expect($response)->toBeArray();
    // Ensure that the status code is 200
    expect($response['status_code'])->toBe(200);
});