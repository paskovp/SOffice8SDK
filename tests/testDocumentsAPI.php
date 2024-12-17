<?php

use Stepsoft\Soffice8sdk\SOffice8\DocumentsAPI;
use Stepsoft\Soffice8sdk\SOfficeRequest;

test('Test DocumentsAPI', function () {
    
    //Replace Token with your own
    $client = new SOfficeRequest(
        'http://192.168.0.106:8081/', 
        //'https://soffice8api.stepsoft.bg/', 
        'v1', 
        'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJzdXBwb3J0QHN0ZXBzb2Z0LmJnIiwic3ViIjoiQVBJIiwiZGF0YWJhc2UiOiJTT2ZmaWNlOF9NYWdudW1DeXBydXMyMDIyIiwiZXhwIjoxNzM0MTc0OTk2LjE3ODUyM30.pgh1B_OGGKcyq7IsepmOFQuFdh0nA5FJYMWHiHOyGGQ');
    
    $testDocumentsAPIRequest = new DocumentsAPI($client);

    $response = $testDocumentsAPIRequest->fetchById(
        30, //id of the doctype to get the records from
        263 //id of the document
    );

    var_dump($response);

    // Ensure that the response is an object
    expect($response)->toBeArray();
    // Ensure that the status code is 200
    expect($response['status_code'])->toBe(200);
});