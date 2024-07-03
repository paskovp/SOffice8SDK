<?php

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Stepsoft\Soffice8sdk\SOffice8\NmclAPI;
use Stepsoft\Soffice8sdk\SOfficeRequest;

test('Test DocumentsAPI', function () {
    
    //Replace Token with your own
    $client = new SOfficeRequest(
        'https://soffice8api.stepsoft.bg/', 
        'v1', 
        'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJzdXBwb3J0QHN0ZXBzb2Z0LmJnIiwic3ViIjoiQVBJIiwiZGF0YWJhc2UiOiJTT2ZmeWNlOF9TX1RyYWRlIiwiZXhwIjoxNzIwMDE1NTgyLjA4NjEwMX0.vWQMbw-MMH1PDzr0qHEcgIPdCoP0KNhnptPCMUQqwEs');
    
    $testNmclAPIRequest = new NmclAPI($client);

    $response = $testNmclAPIRequest->getNmclRange(
        2,
        0,
        10,
        'id',
        'id'
    );
    var_dump($response);

    // Ensure that the response is an object
    expect($response)->toBeArray();
    // Ensure that the status code is 200
    expect($response['status_code'])->toBe(200);
});