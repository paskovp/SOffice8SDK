<?php

/**
 *
 * The SOffice8API is responsible for sending various HTTP requests to the S-Office 8 server via the Guzzle HTTP cllient.
 *
 */

namespace Stepsoft\Soffice8sdk\SOffice8;

use Stepsoft\Soffice8sdk\SOfficeRequest as Client;

class Lang8API extends BaseAPI
{
    const all_languages_key = 'allLanguages';

    /**
     * Sending a GET request to the server in order to set the language as desired.
     * @param type $lang
     * @return type
     */
    public function setLang($lang)
    {
        $response = $this->client->sendRequest('api/lang/' . $lang, 'GET');
        return $this->validate($response);
    }

    /**
     * Sends a request to the server to get all active languages
     * @return type
     */
    public function getActiveLanguages()
    {
        $response = $this->client->sendRequest('/lang', 'GET');
        $languages = $this->validate($response);

        return \Languages::setLanguages($languages);
    }

    public function getAllLanguages()
    {
        if (session()->has(self::all_languages_key)) {
            return session()->get(self::all_languages_key);
        }
        $response = $this->client->sendRequest('/api/languages', 'GET');
        $languages = $this->validate($response);

        if (isset($languages['data'])) {
            session()->put(self::all_languages_key, $languages['data']);
            return $languages['data'];
        }
        return [];
    }
}
