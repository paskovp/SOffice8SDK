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

    public function getReportsResult($id_report, $params) {
        $uri = '/reports/show/' . $id_report;
        $response = $this->client->sendRequest($this->addParams($uri, $params), 'GET');

        return $this->validate($response);
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
