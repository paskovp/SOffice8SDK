<?php

namespace Stepsoft\Soffice8sdk\SOffice8;

use Stepsoft\Soffice8sdk\SOfficeRequest as Client;
use Illuminate\Support\Facades\Config;

class UIAPI extends BaseAPI
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
     * Get all navigations or a specific one
     * @param type $type
     * @return type
     */
    public function getNavigations($type = null)
    {
        if ($type) {
            $response = $this->client->sendRequest('ui/navigation', 'GET');
        } else {
            $response = $this->client->sendRequest('ui/navigation/' . $type, 'GET');
        }
        return $this->validate($response);
    }

    /**
     * Return widget information by its id
     * @param type $widget_id
     * @return type
     */
    public function getWidgetById($widget_id)
    {
        $response = $this->client->sendRequest('ui/widget/' . $widget_id . '?client_route=' . \Session::get('client_route'), 'GET');
        return $this->validate($response);
    }

    /**
     * Returns all available widgets for the curent user
     * and their descriptions
     */
    public function getAvailableWidgets($id)
    {
        $url = 'ui/widget' . (is_null($id) ? '' : '/' . $id);
        $response = $this->client->sendRequest($url, 'GET');
        //        echo"<pre>";
        //        print_r($response);
        //        echo"</pre>";die;
        $widgets = $this->validate($response);

        if (isset($widgets['data'])) {
            return $widgets['data'];
        }

        return false;
    }

    /**
     * Updates the widget position and size in the database,
     * or emoves a widget from the current page
     * @param type $widget_id
     * @param type $input
     */
    public function modifyWidget($widget_id, $input = null)
    {
        $input['client_route'] = \Session::get('client_route');
        $response = $this->client->sendRequest('ui/widget/' . $widget_id . '/modify', 'POST', $input);
        return $this->validate($response);
    }

    /**
     * Get the last opened and  tracked client's URL
     * from the server, according curent loged user
     * and the device(in this case - web)
     */
    public function getLastVisitedURL()
    {
        $response = $this->client->sendRequest('ui/lasturl/web', 'GET');
        return $this->validate($response);
    }

    /**
     * Sends a request to the server to home page
     * @return type
     */
    public function process()
    {
        $response = $this->client->sendRequest('/process', 'GET');
        return $this->validate($response);
    }

    public function loadgetTranslations()
    {
        $device = Config::get('soffice.device');

        $response = $this->client->sendRequest('/config/translations/' . $device, 'GET');
        return $this->validate($response);
    }
}
