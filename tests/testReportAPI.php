<?php

use Stepsoft\Soffice8sdk\SOffice8\ReportAPI;
use Stepsoft\Soffice8sdk\SOfficeRequest;

test('Test ReportAPI', function () {
    
    //Replace Token with your own
    $client = new SOfficeRequest(
        'http://192.168.0.106:8081/', 
        //'https://soffice8api.stepsoft.bg/', 
        'v1', 
        'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJzdXBwb3J0QHN0ZXBzb2Z0LmJnIiwic3ViIjoiQVBJIiwiZGF0YWJhc2UiOiJTT2ZmaWNlOF9NYWdudW1DeXBydXMiLCJleHAiOjE3MzI1NDkwMTkuNjQ3NDAyfQ.qTRsM3yOGpkri6Z3PXkyRAOeC2AtJoornMpgGcdpOC8');
    
    $testReportAPIRequest = new ReportAPI($client);

    $response = $testReportAPIRequest->getReportResultAPI(
        145, //id of the report to get the records from
        '40', //number of rows requested
        '1', //start page
        '', //number of rows
        '', //page number
    );

    //var_dump($response);

    // Ensure that the response is an object
    expect($response)->toBeArray();
    // Ensure that the status code is 200
    expect($response['status_code'])->toBe(200);
});