<?php

/**
 * 
 * The SOffice8API is responsible for sending various HTTP requests to the S-Office 8 server via Guzzle HTTP cllient.
 * 
 */

namespace Stepsoft\Soffice8sdk\SOffice8;

use Stepsoft\Soffice8sdk\SOfficeRequest as Client;

class ReportAPI extends BaseAPI {

    /**
     * Importing the SOffice Client Request classwith predefined domain name.
     * @param Client $client
     */
    public function __construct(Client $client) {
        parent::__construct($client);
    }

    public function getReportResultAPI($id_report, $id_report_setting, $config = true, $requestedrows = null, $startpage = null, 
    $rows = null, $configFilters = null, $filters = null, $sortbycolumn = null, $sortdirection = null) {
 
        if ($config) {
            $uri = '/reports/config/'.$id_report;
            if (isset($configFilters)) {
                // Handle both array and JSON string inputs
                if (is_string($configFilters)) {
                    $configParams = json_decode($configFilters, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        throw new \Exception('Invalid JSON string for configFilters');
                    }
                } else {
                    $configParams = $configFilters;
                }

                // Include jwt_token in params so all parameters are in flat query string format
                // This prevents sendRequest from adding jwt_token separately (which would create malformed URL)
                if (!empty($this->client->jwt_token)) {
                    $configParams['jwt_token'] = $this->client->jwt_token;
                }

                // Build URI with all parameters (including jwt_token) in flat format
                $uriWithParams = $uri . '?' . http_build_query($configParams);
                
                // Call sendRequest with empty array to prevent it from adding jwt_token again
                // Use a temporary workaround: set jwt_token to null, call sendRequest, then restore it
                $originalToken = $this->client->jwt_token;
                $this->client->jwt_token = null;
                $response1 = $this->client->sendRequest($uriWithParams, 'GET', []);
                $this->client->jwt_token = $originalToken;

            } else {
                $response1 = $this->client->sendRequest($uri, 'GET');
            }
            return $this->validate($response1);
        }    

        $data = [
            'id_report' => $id_report, //id of the report to get the records from
            'id_report_setting' => $id_report_setting, //id of the report to get the records from
            'config' => $config, //config parameter (true/false) - if true, it will return the configuration of the report
        ];

        // Only add optional parameters if they have values
        if ($requestedrows !== null) {
            $data['requestedrows'] = $requestedrows;
        }
        if ($startpage !== null) {
            $data['startpage'] = $startpage;
        }
        if ($rows !== null) {
            $data['rows'] = $rows;
        }
        if ($configFilters !== null) {
            $data['configFilters'] = $configFilters;
        }
        if ($filters !== null) {
            $data['filters'] = $filters;
        }
        if ($sortbycolumn !== null) {
            $data['sortbycolumn'] = $sortbycolumn;
        }
        if ($sortdirection !== null) {
            $data['sortdirection'] = $sortdirection;
        }
    

        $response2 = $this->client->sendRequest('reports/reportAPI', 'POST', $data);

        return $this->validate($response2);
    }

    public function getAllReportTabsResult($data) {
        $uri = '/reports/getAllReportTabsResult';
        $response = $this->client->sendRequest($this->addParams($uri, $data),'GET');

        return $this->validate($response);
    }

    /**
     * Return list of reports
     * @return type
     */
    public function index() {
        $response = $this->client->sendRequest('/reports', 'GET');
        return $this->validate($response);
    }

    /**
     * Returns report configuration settings
     * @return type
     */
    public function getReportsByGroup($id) {
        $response = $this->client->sendRequest('/reports/group/' . $id . '', 'GET');
        return $this->validate($response);
    }

    /**
     * Returns report configuration settings
     * @return type
     */
    public function getReportConfig($id_report, $params, $internal_num)
    {
        if (isset($internal_num))
            $uri = '/reports/config/' . $id_report . '/' . $internal_num;
        else
        $uri = '/reports/config/' . $id_report;

        $response = $this->client->sendRequest($this->addParams($uri, $params), 'GET');
        return $this->validate($response);
    }

    /**
     * Returns report filters
     * @return type
     */
    public function getReportFilters($id_report,$internal_num=null, $filters=null) {
        $response = $this->client->sendRequest('/reports/' . $id_report . '', 'GET',$filters);
        return $this->validate($response);
    }

    /**
     * Change report row
     * @return type
     */
    public function changeReport($id_report, $params) {
        $uri = '/reports/change/' . $id_report;
        $response = $this->client->sendRequest($this->addParams($uri, $params), 'GET');

        return $this->validate($response);
    }

}
