<?php

use Stepsoft\Soffice8sdk\SOffice8\ReportAPI;
use Stepsoft\Soffice8sdk\SOfficeRequest;

test('Test ReportAPI', function () {
    
    //Replace Token with your own
    $client = new SOfficeRequest(
        //'http://192.168.0.106:8081/', 
        'https://soffice8api.stepsoft.bg/', 
        'v1', 
        'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJwYXNrb0BzdGVwc29mdC5iZyIsInN1YiI6IkFQSSIsImRhdGFiYXNlIjoiU09mZmljZThfU19EZXZlbG9wZXJOZXciLCJleHAiOjE3MjI4NzUzODguMTk0NzQzfQ.Ay7lDuulQl6kgtiWksJj1kW9RGMqrOp6Q0LULRU4_i4');
    
    $testReportAPIRequest = new ReportAPI($client);

    $response = $testReportAPIRequest->getReportResultAPI(
        141, //id of the report to get the records from
        '4', //number of rows requested
        '1', //start page
        '1', //number of rows
        '1', //page number
    );

    // Ensure that the response is an object
    expect($response)->toBeArray();
    // Ensure that the status code is 200
    expect($response['status_code'])->toBe(200);
});