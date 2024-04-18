<?php

namespace Stepsoft\Soffice8sdk\SOffice8;

use Stepsoft\Soffice8sdk\SOfficeRequest as Client;

class FormsAPI extends BaseAPI {

    /**
     * Importing the SOffice Client Request classwith predefined domain name.
     * @param Client $client
     */
    public function __construct(Client $client) {
        parent::__construct($client);
    }

    /**
     * Discard cache changes of given form. The input should contains
     * form id, and form cache_id as well.
     * @param type $id_form
     * @param type $cache_id
     */
    public function discardFormChanges($input) {
        $response = $this->client->sendRequest('/form/cache/discard', 'POST', $input);
        return $this->validate($response);
    }

    /**
     * Form changed
     */
    public function formChange($input) {
        $response = $this->client->sendRequest('/form/object/change', 'POST', $input);
        return $this->validate($response);
    }

    /**
     * Discard all cache changes.
     */
    public function discardFormChangesAll() {
        $response = $this->client->sendRequest('/form/cache/discard/all', 'GET');
        return $this->validate($response);
    }

    /**
     * Get all opened objects
     * @return type
     */
    public function getOpenedObjects($params = array()) {
        $url = '/form/opened';
        if(!empty($params)){
            foreach ($params as $param){
                $url .= '/' .$param;
            }
        }
        $response = $this->client->sendRequest($url, 'GET');
        return $this->validate($response);
    }

}
