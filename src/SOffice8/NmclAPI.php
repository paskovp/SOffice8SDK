<?php

namespace Stepsoft\Soffice8sdk\SOffice8;

use Stepsoft\Soffice8sdk\SOfficeRequest as Client;

class NmclAPI extends BaseAPI {

    /**
     * Importing the SOffice Client Request classwith predefined domain name.
     * @param Client $client
     */
    public function __construct(Client $client) {
        parent::__construct($client);
    }

    /**
     * Returns all roles in the system
     * @return type
     */
    public function allNmcl() {
        $response = $this->client->sendRequest('nmcl', 'GET');
        return $this->validate($response);
    }

    /**
     * 
     * @param type $id
     * @param type $params
     * @return type
     */
    public function getnmcl($id, $params) {
        $uri = 'nmcl/' . $id;
        $response = $this->client->sendRequest($this->addParams($uri, $params), 'GET');
        return $this->validate($response);
    }

    /**
     * Getting a range of records from a NMCL
     * @param int $id
     * @param int $rangeFrom
     * @param int $rangeTo
     * @return type
     */
     public function getNmclRange($id, $rangeFrom, $rangeTo, $sortByColumn, $sortDirection, $filterByColumn, $filterValue, $filterByLastChange, $sendFiles) {

        $data = [
            'id' => $id, //id of the Nmcl to get the records within the range from
            'rangeFrom' => $rangeFrom, //start id value of the range from which to get the records
            'rangeTo' => $rangeTo, //end id value of the range to which to get the records
            'sortByColumn' => $sortByColumn, //column to sort by, 'id' by default
            'sortDirection' => $sortDirection, //'asc' by default, can be 'desc'
            'filterByColumn' => $filterByColumn, //column to filter by
            'filterValue' => $filterValue, //value to filter by
            'filterByLastChange' => $filterByLastChange, //datetime format string to filter result by datetime of last change (newer than the given value)
            'sendFiles' => $sendFiles //boolean value to send files with the response
        ];

        $response = $this->client->sendRequest('nmcl/getRange', 'POST', $data);

        return $this->validate($response);
     }


    /**
     * Returns all users in the system
     * @return type
     */
    public function create($id, $internal_num) {
        if ($internal_num) {
            $response = $this->client->sendRequest('nmcl/' . $id . '/add/' . $internal_num, 'GET');
        } else {
            $response = $this->client->sendRequest('nmcl/' . $id . '/add', 'GET');
        }
        return $this->validate($response);
    }

    /**
     * Returns all users in the system
     * @return type
     */
    public function edit($id, $row, $internal_num) {
        if ($internal_num) {
            $response = $this->client->sendRequest('nmcl/' . $id . '/row/' . $row . '/' . $internal_num, 'GET');
        } else {
            $response = $this->client->sendRequest('nmcl/' . $id . '/row/' . $row, 'GET');
        }

        return $this->validate($response);
    }

    /**
     * Saving new row of NMCL
     * @param type $userId
     * @return type
     */
    public function store($id, $data) {
        $response = $this->client->sendRequest('nmcl/' . $id, 'POST', $data);

        return $this->validate($response);
    }

    /**
     * Getting new gridTable of NMCL
     * @param type $userId
     * @return type
     */

     public function nmclProcedureStore($id,$internalNumber,$groupedElement,$sectionId,$formId){

        $response = $this->client->sendRequest('nmclProcedureStore/' . $id . '/' . $internalNumber .'/'. $groupedElement . '/' . $sectionId . '/' . $formId, 'POST');

        return $this->validate($response);
     }

    /**
     * Getting new gridTable of NMCL
     * @param type $userId
     * @return type
     */

    public function gridNmclTable($id,$sectionId,$internal_num,$groupByElement){
        if ($internal_num) {
            $response = $this->client->sendRequest('nmcl/' . $id . '/' . $sectionId . '/' . $internal_num . '/' . $groupByElement, 'GET');
        } else {
            $response = $this->client->sendRequest('nmcl/' . $id . '/' . $sectionId, 'GET');
        }

        return $this->validate($response);
    }

    /**
     * Getting gridTable rows of NMCL
     * @param type $userId
     * @return type
     */

     public function editGridTable($id,$sectionId,$internal_num,$rows_group,$id_grid_row,$groupedElement,$destinationPage,$searchValue){
        if ($internal_num) {
            $response = $this->client->sendRequest('nmcl/editGridTable/' . $id . '/' . $sectionId . '/' . $internal_num . '/' . $rows_group . '/' . $id_grid_row . '/' . trim($groupedElement) . '/' . $destinationPage . '/' . $searchValue, 'GET');
        } else {
            $response = $this->client->sendRequest('nmcl/editGridTable/' . $id . '/' . $sectionId, 'GET');
        }

        return $this->validate($response);
    }

    
    /**
     * Get the last id_grid_record from a the specific nmcl
     * @param type $id
     * @param type $row
     * @return type
     */

    public function getLastGridRow($data){
        $response = $this->client->sendRequest('nmcl/getLastGridRow' , 'POST' , $data);
        return $this->validate($response);
    }

    /**
     * Get all dynamic elements from the dynamic sections
     * @param type $userId
     * @return type
     */

     public function getDynamicElementsBySectionId($data){
        $response = $this->client->sendRequest('dynamicProp/getDynamicElementsBySectionId' , 'POST', $data);

        return $this->validate($response);
    }

    /**
     * Get all dynamic elements from the dynamic sections
     * @param type $userId
     * @return type
     */

     public function getDynamicElementsValues($data){
        $response = $this->client->sendRequest('dynamicProp/getDynamicElementsValues' , 'POST', $data);

        return $this->validate($response);
    }

    /**
     * Getting gridTable rows of NMCL
     * @param type $userId
     * @return type
     */

     public function checkIsChangedState($internal_num,$section_id,$form_id){
            $response = $this->client->sendRequest('nmcl/checkIsChangedState/' . $internal_num . '/' . $section_id . '/' . $form_id , 'POST');


        return $this->validate($response);
    }
    /**
     * Restoring the state of a given group in a gridNmcl
     * @param type $userId
     * @return type
     */

     public function restoreNmcl($data){
            $response = $this->client->sendRequest('nmcl/restoreNmcl', 'POST', $data);


        return $this->validate($response);
    }

    /**
     * Deletes a record from given nomenclature
     * @param type $id
     * @param type $row
     * @return type
     */
    public function destroy($id, $row) {
        $response = $this->client->sendRequest('nmcl/destroy/' . $id . '/' . $row, 'GET');
        return $this->validate($response);
    }
    
    /**
     * Deletes a record from given nomenclature
     * @param type $id
     * @param type $row
     * @return type
     */
    public function deleteNmclRow($data) {
        $response = $this->client->sendRequest('nmcl/deleteNmclRow' , 'POST', $data);
        return $this->validate($response);
    }

}
