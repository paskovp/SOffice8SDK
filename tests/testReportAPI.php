<?php

use Stepsoft\Soffice8sdk\SOffice8\ReportAPI;
use Stepsoft\Soffice8sdk\SOfficeRequest;

test('Test ReportAPI', function () {
    
    //Replace Token with your own
    $client = new SOfficeRequest(
        //'http://192.168.0.106:8081/', 
        'https://soffice8api.stepsoft.bg/', 
        'v1', 
        'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJwYXNrb0BzdGVwc29mdC5iZyIsInN1YiI6IkFQSSIsImRhdGFiYXNlIjoiU09mZmljZThfU19EZXZlbG9wZXJOZXciLCJleHAiOjE3MjI4NzI3ODguMTMxOTc4fQ.06gUicZ1iijHpNyC8oj3pDjfNNj64bx4x9mFgInIdBc');
    
    $testReportAPIRequest = new ReportAPI($client);

    //var_dump($testReportAPIRequest);

    $response = $testReportAPIRequest->getReportResultAPI(
        141, //id of the report to get the records from
        '40', //number of rows requested
        '1', //start page
        '40', //number of rows
        '1', //page number
    );

    //var_dump($response);

    // Ensure that the response is an object
    expect($response)->toBeArray();
    // Ensure that the status code is 200
    expect($response['status_code'])->toBe(200);
});