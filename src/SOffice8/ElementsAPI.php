<?php

namespace Stepsoft\Soffice8sdk\SOffice8;

use Stepsoft\Soffice8sdk\SOfficeRequest as Client;

class ElementsAPI extends BaseAPI {

    /**
     * Importing the SOffice Client Request classwith predefined domain name.
     * @param Client $client
     */
    public function __construct(Client $client) {
        parent::__construct($client);
    }

    /**
     * Returns element config by refmap id
     * @return type
     */
    public function getElementValuesByRefMapId($id,$data=[]) {
        $response = $this->client->sendRequest('element/' . $id, 'post',$data);
        return $this->validate($response);
    }

    /**
     * Updates the cache table of the given form for the given element name and value
     * @param type $id_form
     * @param type $element_value
     * @param type $element_name
     * @return type
     */
    public function updateElementCache($id_form, $element_value = null, $element_name, $internal_number, $refmap_id, $section_id, $id_grid_row, $rows_group,$groupByElement,$is_changed,$origin = null,$id_object = null,$gridElType = null,$refmap_dynamic_id,$element_id) {
        $response = $this->client->sendRequest('form/' . $id_form . '/cache/element/' . $element_name, 'POST', ['element_value' => $element_value, 'internal_number' => $internal_number, 'refmap_id' => $refmap_id, 'id_grid_row' => $id_grid_row, 'section_id' => $section_id, 'rows_group' => $rows_group, 'groupByElement' => $groupByElement,'is_changed' => $is_changed,'origin' => $origin,'id_object' => $id_object, 'gridElType' => $gridElType,'refmap_dynamic_id' => $refmap_dynamic_id,'element_id' => $element_id]);
        return $this->validate($response);
    }

    /**
     * Get subgrid rows based on selected row from another section
     * @param type $id_form
     * @param type $element_value
     * @param type $element_name
     * @return type
     */
    public function getSubGrid($id_form, $id_section, $internal_number, $id_grid_row) {
        $response = $this->client->sendRequest('form/' . $id_form . '/subgrid/' . $id_section, 'POST', [
            'internal_number' => $internal_number,
            'id_grid_row' => $id_grid_row,
        ]);

        return $this->validate($response);
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
    public function updateElementDependency($id_form,$internal_number){
        $url = "updateElementDependency/form/$id_form/internal_number/$internal_number";
        $response = $this->client->sendRequest($url, 'post',[1=>12]);
        return $this->validate($response);
    }
}
