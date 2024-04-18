<?php

namespace Stepsoft\Soffice8sdk\SOffice8;

use Stepsoft\Soffice8sdk\SOfficeRequest as Client;

class DynamicPropAPI extends BaseAPI {

    /**
     * Importing the SOffice Client Request classwith predefined domain name.
     * @param Client $client
     */
    public function __construct(Client $client) {
        parent::__construct($client);
    }

    // Gathering all nmcls which have dynamic sections
    public function Nmcls_withDynamicSections(){

        $response = $this->client->sendRequest('/dynamicProp/Nmcls_withDynamicSections', 'GET');
        return $this->validate($response);
    }

    // Gathering sections of the selected Nmcl
    public function getDynamicSections($id){

        $response = $this->client->sendRequest('/dynamicProp/getDynamicSections', 'GET',[$id]);
        return $this->validate($response);
    }

    // Get relationElement from selected section
    public function getRelationElement($id){

        $response = $this->client->sendRequest('/dynamicProp/getRelationElement', 'GET',[$id]);
        return $this->validate($response);
    }

    // Get all nmcls used for creating a new dynamic element of type [select]
    public function getAllNmcls(){

        $response = $this->client->sendRequest('/dynamicProp/getAllNmcls', 'GET');
        return $this->validate($response);
    }

    // Get all elements associated with the selected nmcl for a new dynamic element of type [select]
    public function getNmclElements($id){
        
        $response = $this->client->sendRequest('/dynamicProp/getNmclElements', 'GET',[$id]);
        return $this->validate($response);
    }

    // Get all dynamic elements for dataTable load
    public function getDynamicElements(){
        
        $response = $this->client->sendRequest('/dynamicProp/getDynamicElements', 'GET');
        return $this->validate($response);
    }

    // Create new dynamic element
    public function createNewDynamicElement($data){
        
        $response = $this->client->sendRequest('/dynamicProp/createNewDynamicElement', 'POST',$data);
        return $this->validate($response);
    }

    // Edit dynamic element
    public function editDynamicElement($id){
        $response = $this->client->sendRequest('/dynamicProp/editDynamicElement', 'GET',[$id]);
        return $this->validate($response);
    }

    // Save dynamic element's values
    public function editDynamicElementUpdate($data){
        $response = $this->client->sendRequest('/dynamicProp/editDynamicElementUpdate', 'POST', $data);
        return $this->validate($response);
    }

    // Save dynamic element on edit
    public function editDynamicElementSave($data){
        $response = $this->client->sendRequest('/dynamicProp/editDynamicElementSave', 'POST', $data);
        return $this->validate($response);
    }

    // Store the newly created dynamic element into refMap_dynamic
    public function storeRelationElementRefMap($data){
        
        $response = $this->client->sendRequest('/dynamicProp/storeRelationElementRefMap', 'POST',$data);
        return $this->validate($response);
    }
    
    // Delete an already existing dynamic element
    public function deleteDynamicElement($data){
        
        $response = $this->client->sendRequest('/dynamicProp/deleteDynamicElement', 'POST',$data);
        return $this->validate($response);
    }
}
