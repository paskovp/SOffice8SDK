<?php

namespace Stepsoft\Soffice8sdk\SOffice8;

use Stepsoft\Soffice8sdk\SOfficeRequest as Client;

class PrintFormsAPI extends BaseAPI {

    /**
     * Importing the SOffice Client Request classwith predefined domain name.
     * @param Client $client
     */
    public function __construct(Client $client) {
        parent::__construct($client);
    }

    /**
     * Returns all document print forms in the system base don user permissions
     * @return type
     */
    public function getPrintForms($id_doctype) {
        $response = $this->client->sendRequest('print/document/' . $id_doctype, 'GET');
        return $this->validate($response);
    }
    
    /**
     * Returns all report print forms in the system base don user permissions
     * @return type
     */
    public function getReportPrintForms($id_report) {
        $response = $this->client->sendRequest('print/report/' . $id_report, 'GET');
        return $this->validate($response);
    }

    /**
     * Returns document print form html
     * @param $doctype
     * @return type
     */
    public function getDocumentPrintForm($objectId, $printformid, $documentId) {
        $uri = 'print/document/' . $objectId . '/' . $printformid . '/' . $documentId;
        $response = $this->client->sendRequest($uri, 'GET');

        return $this->validate($response);
    }
    public function sendEmailDocumentPrintForm($objectId, $printformid, $documentId) {
        $uri = 'print/send/email/' . $objectId . '/' . $printformid . '/' . $documentId;
        $response = $this->client->sendRequest($uri, 'GET');
        if($response['status_code'] == 401){
            return $response;
        }
        return $this->validate($response);
    }
    
    /**
     * Returns report print form html
     * @param $doctype
     * @return type
     */
    public function getReportPrintForm($objectId, $printformid, $input) {
        $uri = 'print/report/' . $objectId . '/' . $printformid;
        $response = $this->client->sendRequest($this->addParams($uri, $input), 'GET');

        return $this->validate($response);
    }

}
