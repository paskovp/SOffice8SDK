<?php

use Stepsoft\Soffice8sdk\SOffice8\FilesAPI;
use Stepsoft\Soffice8sdk\SOfficeRequest;

test('Test FilesAPI', function () {
    
    //Replace Token with your own
    $client = new SOfficeRequest(
        //'http://192.168.0.106:8081/', 
        'https://soffice8api.stepsoft.bg/', 
        'v1', 
        'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJwYXNrb0BzdGVwc29mdC5iZyIsInN1YiI6IkFQSSIsImRhdGFiYXNlIjoiU09mZmljZThfU19EZXZlbG9wZXJOZXcyMDI0MDcxNiIsImV4cCI6MTcyMTk5Nzk3OS4wOTEyMzR9.SvxH7AjzCUUb5B8iQcIc1zLNQV8ZEElUv-YbqSbgD-g');
    
    $testFilesAPIRequest = new FilesAPI($client);

    $response = $testFilesAPIRequest->downloadFile(
        'tv_44646.jpg',
        'nomenclature',
    );

    //var_dump($response);

    // Ensure that the response is an object
    expect($response)->toBeArray();
    // Ensure that the status code is 200
    expect($response['status_code'])->toBe(200);
});