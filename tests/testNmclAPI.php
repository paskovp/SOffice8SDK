<?php

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Stepsoft\Soffice8sdk\SOffice8\NmclAPI;
use Stepsoft\Soffice8sdk\SOfficeRequest;

test('Test NmclAPI', function () {
    
    //Replace Token with your own
    $client = new SOfficeRequest(
        'https://soffice8api.stepsoft.bg/', 
        'v1', 
        'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJwYXNrb0BzdGVwc29mdC5iZyIsInN1YiI6IkFQSSIsImRhdGFiYXNlIjoiU09mZmljZThfU19EZXZlbG9wZXJOZXciLCJleHAiOjE3MjAyOTQ0OTEuNTgyODc2fQ.G2NPSbvLcXDmaCEbKC-VVfpVp3aF3jmu5pejCKhTi0E');
    
    $testNmclAPIRequest = new NmclAPI($client);

    $response = $testNmclAPIRequest->getNmclRange(
        17,
        '',
        '',
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