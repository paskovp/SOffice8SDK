<?php

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Stepsoft\Soffice8sdk\SOffice8\DocumentsAPI;
use Stepsoft\Soffice8sdk\SOfficeRequest;

test('Test DocumentsAPI', function () {
    
    $client = new SOfficeRequest(
        'https://soffice8api.stepsoft.bg/', 
        'v1', 
        'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJzdXBwb3J0QHN0ZXBzb2Z0LmJnIiwic3ViIjoiQVBJIiwiZGF0YWJhc2UiOiJTT2ZmaWNlOF9TX1RyYWRlIiwiZXhwIjoxNzEzMjY5Mjg4LjcwODYwNn0.cICsCglDIreeFyHgTRvLLtsSh8kd8pKpV46QeAbrlR4');
    
    $testDocumentsAPIRequest = new DocumentsAPI($client);

    $response = $testDocumentsAPIRequest->index();

    // Ensure that the response is an object
    expect($response)->toBeArray();
    // Ensure that the status code is 200
    expect($response['status_code'])->toBe(200);
});