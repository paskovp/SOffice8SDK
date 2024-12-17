<?php

use Stepsoft\Soffice8sdk\SOffice8\ReportAPI;
use Stepsoft\Soffice8sdk\SOfficeRequest;

test('Test ReportAPI', function () {
    
    //Replace Token with your own
    $client = new SOfficeRequest(
        //'http://192.168.0.106:8081/', 
        'https://soffice8api.stepsoft.bg/', 
        'v1', 
        'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJkZXNpZ25Adml2LWRlc2lnbi5jb20iLCJzdWIiOiJBUEkiLCJkYXRhYmFzZSI6IlNPZmZpY2U4X01hZ251bUN5cHJ1cyIsImV4cCI6MTczNDQ1Njg1Ni41MzA3NDR9.NJbaV7h6-MErySWbMQlQRxPL_vy7OoHVeG1HGe9IfmE');
    
    $testReportAPIRequest = new ReportAPI($client);

    $response = $testReportAPIRequest->getReportResultAPI(
        99, //id of the report to get the records from
        145, //id of the reportSetting (sub-report view) to get the records from
        '100', //number of rows requested
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