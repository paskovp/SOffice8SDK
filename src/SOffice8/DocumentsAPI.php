<?php

namespace Stepsoft\Soffice8sdk\SOffice8;

use Stepsoft\Soffice8sdk\SOfficeRequest as Client;

class DocumentsAPI extends BaseAPI
{

    /**
     * Importing the SOffice Client Request classwith predefined domain name.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    /**
     * Returns all documents in the system base don user permissions
     * @return type
     */
    public function index()
    {
        $response = $this->client->sendRequest('documents', 'GET');
        return $this->validate($response);
    }

    /**
     * Returns all documents by given type in the system based on user permissions
     * @param $doctype
     * @return type
     */
    public function getAllByType($doctype, $params = null)
    {
        $uri = 'documents/' . $doctype;
        $response = $this->client->sendRequest($this->addParams($uri, $params), 'GET');

        return $this->validate($response);
    }

    /**
     * Create documents by given type in the system 
     * @param type $doctype
     * @param type $internal_num
     * @param type $inputParam
     * @return type
     */
    public function create($doctype, $internal_num = null, $inputParam = [])
    {
        if (isset($internal_num)) {
            $response = $this->client->sendRequest('documents/' . $doctype . '/add/' . $internal_num, 'GET', $inputParam);
        } else {
            $response = $this->client->sendRequest('documents/' . $doctype . '/add', 'GET', $inputParam);
        }
        return $this->validate($response);
    }

    /**
     * Get documents by given type in the system 
     * @param type $doctype
     * @param type $internal_num
     * @param type $inputParam
     * @return type
     */
    public function fetchById($id_doctype, $doc_id)
    {
        $data = [
            'id_doctype' => $id_doctype, //id of the doctype to get the information from
            'doc_id' => $doc_id //id of the document 
        ];

        $response = $this->client->sendRequest('documents/fetchById', 'POST', $data);

        return $this->validate($response);
    }

    /**
     * Add document from a report
     * @param type $doctypeID
     * @param type $create_from_type
     * @param type $create_from_id
     * @return type
     */

    public function createAndFillDocumentByReport($doctype, $create_from_type, $create_from_id)
    {
        $data = ['create_from_type' => $create_from_type, 'create_from_id' => $create_from_id];
        $response = $this->client->sendRequest('documents/' . $doctype . '/createbyreport', 'POST', $data);
        return $this->validate($response);
    }

    /**
     * Create new document by inheritance
     * @param type $doctypeID
     * @param type $data
     */
    public function createAndFillDocumentByInheritance($doctype, $data = array())
    {
        $response = $this->client->sendRequest('documents/' . $doctype . '/createbyinheritance', 'POST', $data);
        return $this->validate($response);
    }

    /**
     * Add row to document section
     * @param $data
     * @return int
     */
    public function addrow($data)
    {
        $response = $this->client->sendRequest('/addrow', 'POST', $data);
        return $this->validate($response);
    }

    /**
     * Add row to document section
     * @param $data
     * @return int
     */
    public function getLastSubGridRowId($data)
    {
        $response = $this->client->sendRequest('documents/getLastSubGridRowId', 'POST', $data);
        return $this->validate($response);
    }

    /**
     * Get spcific rows for a sub-grid section
     * @param $data
     * @return int
     */

    public function getSubGridRow($data){
        $response = $this->client->sendRequest('/getSubGridRow','GET',$data);
        return $this->validate($response);
    }

    /**
     * Add rows group to document section
     * @param $data
     * @return int
     */
    public function addrowsgroup($data)
    {
        $response = $this->client->sendRequest('/addrowsgroup', 'POST', $data);
        return $this->validate($response);
    }

    /**
     * Remove row from document section
     * @param $data
     * @return type
     */
    public function removerow($data)
    {
        $response = $this->client->sendRequest('/removerow', 'POST', $data);
        return $this->validate($response);
    }

    /**
     * Store documents by given type in the system 
     * @param $data
     * @return type
     */
    public function store($doctype, $data)
    {
        $response = $this->client->sendRequest('documents/' . $doctype, 'POST', $data);
        return $this->validate($response);
    }

    public function SqlCheckErrorBeforeSaveRequest($doctype,$data){

        $response = $this->client->sendRequest('documents/SqlCheckErrorBeforeSave/' . $doctype, 'POST', $data);
        return $this->validate($response);
    }

    /**
     * Edit documents by given type in the system 
     * @param $data
     * @return type
     */
    public function edit($id, $row, $internal_num)
    {
        if ($internal_num) {
            $response = $this->client->sendRequest('documents/' . $id . '/row/' . $row . '/' . $internal_num, 'GET');
        } else {
            $response = $this->client->sendRequest('documents/' . $id . '/row/' . $row, 'GET');
        }
        return $this->validate($response);
    }

    /**
     * Returns all documents search engine by given type in the system based on user permissions
     * @param $id_doctype
     * @return type
     */
    public function search($id_doctype)
    {
        $uri = 'documents/search/' . $id_doctype;
        $response = $this->client->sendRequest($uri, 'GET');

        return $this->validate($response);
    }

    /**
     * Returns all documents search engine by given type in the system based on user permissions
     * @param $id_doctype
     * @return type
     */
    public function searchConfig($id_doctype, $id_document_search, $internal_number)
    {
        $uri = 'documents/searchconfig/' . $id_doctype . '/' . $id_document_search . '/' . $internal_number;
        $response = $this->client->sendRequest($uri, 'GET');
        return $this->validate($response);
    }

    /**
     * Returns all documents search engine by given type in the system based on user permissions
     * @param $id_doctype
     * @return type
     */
    public function searchResult($id_doctype, $id_document_search, $internal_number)
    {
        $uri = 'documents/searchresult/' . $id_doctype . '/' . $id_document_search . '/' . $internal_number;
        $response = $this->client->sendRequest($uri, 'GET');

        return $this->validate($response);
    }

    /**
     * Add row to document section from document search
     * @param $data
     * @return int
     */
    public function addSearchRows($data)
    {
        $response = $this->client->sendRequest('documents/addsearchrows', 'POST', $data);
        return $this->validate($response);
    }

    /**
     * Annul a document using the document id_doctype ($id) and the document id_title ($id_title) 
     * @param $data
     * @return int
     */
    public function destroy($id, $id_title)
    {
        $response = $this->client->sendRequest("documents/destroy/$id/$id_title", 'POST', [$id]);
        return $this->validate($response);
    }

    /**
     * Save document into state
     * @param $data
     * @return type
     */
    public function saveDocumentIntoState($data)
    {
        
        $response = $this->client->sendRequest('documents/saveDocumentIntoState_API_END_POINT', 'POST', $data);
        return $this->validate($response);
    }

    /**
     * Save document sql
     * @param $data
     * @return type
     */
    public function saveDocumentDataSql($data)
    {
        $response = $this->client->sendRequest('documents/saveDocumentDataSql_API_END_POINT', 'POST', $data);
        return $this->validate($response);
    }


    public function insertIntoStateAndSaveDocument($data)
    {
        $response = $this->client->sendRequest('documents/insertIntoStateAndSaveDocument_API_END_POINT', 'POST', $data);
        return $this->validate($response);
    }

}
