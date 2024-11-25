<?php

use Stepsoft\Soffice8sdk\SOffice8\NmclAPI;
use Stepsoft\Soffice8sdk\SOfficeRequest;

test('Test NmclAPI', function () {
    
    //Replace Token with your own
    $client = new SOfficeRequest(
        'https://soffice8api.stepsoft.bg/', 
        'v1', 
        'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJzdXBwb3J0QHN0ZXBzb2Z0LmJnIiwic3ViIjoiQVBJIiwiZGF0YWJhc2UiOiJTT2ZmaWNlOF9NYWdudW1DeXBydXMyMDIyIiwiZXhwIjoxNzMyNTMzODQ3LjgyMDQ1MX0.l7pkgIWSJsU_j4rEJfNkK_YtqHh-KSNylt9Fbv14d8k');
    
    $testNmclAPIRequest = new NmclAPI($client);

    $response = $testNmclAPIRequest->getNmclRange(
        17,
        54209,
        54209,
        '',
        '',
        '',
        '',
        '', 
        false
    );

    //var_dump($response);

    // Ensure that the response is an object
    expect($response)->toBeArray();
    // Ensure that the status code is 200
    expect($response['status_code'])->toBe(200);
});