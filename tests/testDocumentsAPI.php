<?php

use Stepsoft\Soffice8sdk\SOffice8\DocumentsAPI;
use Stepsoft\Soffice8sdk\SOfficeRequest;

test('Test DocumentsAPI', function () {
    
    //Replace Token with your own
    $client = new SOfficeRequest(
        'https://soffice8api.stepsoft.bg/', 
        'v1', 
        'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJzdXBwb3J0QHN0ZXBzb2Z0LmJnIiwic3ViIjoiQVBJIiwiZGF0YWJhc2UiOiJTT2ZmaWNlOF9NYWdudW1DeXBydXMyMDIyIiwiZXhwIjoxNzMyNTMzODQ3LjgyMDQ1MX0.l7pkgIWSJsU_j4rEJfNkK_YtqHh-KSNylt9Fbv14d8k');
    
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