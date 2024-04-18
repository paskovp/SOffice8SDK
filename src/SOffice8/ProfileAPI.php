<?php

namespace Stepsoft\Soffice8sdk\SOffice8;

use Stepsoft\Soffice8sdk\SOfficeRequest as Client;
use Carbon\Carbon;
use App\Models\Repositories\Profile\ProfileRepository;

class ProfileAPI extends BaseAPI
{
    const getProfileData = 'getProfileData';
    /**
     * Importing the SOffice Client Request classwith predefined domain name.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
    }
    public static function CacheFlushGetProfileData()
    {
        \Cache::flush(self::getProfileData);
    }
    /**
     * Returns user profile data
     * @return type
     */
    public function getProfileData()
    {

        $username = session()->get('username', null);
        $key = self::getProfileData . '.' . $username;
        if (!is_null($username) and \Cache::has($key)) {
            return $this->validate(\Cache::get($key));
        }
        $response = $this->client->sendRequest('administration/profile', 'GET');
        $expiresAt = Carbon::now()->addMinutes(30);
        \Cache::put($key, $response, $expiresAt);
        return $this->validate($response);
    }

    public function getAPIVersion(){
        $response = $this->client->sendRequest('administration/profile/apiVersion', 'GET');
        return $this->validate($response);
    }

    /**
     * Returns user profile data
     * @return type
     */
    public function editProfileData()
    {
        $response = $this->client->sendRequest('administration/profile/edit', 'GET');
        return $this->validate($response);
    }

    /**
     * Returns user profile data
     * @return type
     */
    public function createProfile()
    {
        $response = $this->client->sendRequest('administration/profile/create', 'GET');
        return $this->validate($response);
    }

    /**
     * Store user data
     * @return type
     */
    public function storeProfileData($data)
    {
        $response = $this->client->sendRequest('administration/profile/store', 'POST', $data);
        return $response;
        return $this->validate($response);
    }

    /**
     * Store user data
     * @return type
     */
    public function changeAvatar($data)
    {
        $response = $this->client->sendRequest('administration/profile/changeavatar', 'POST', $data);
        return $this->validate($response);
    }

    public function getLayouts()
    {
        $width = (new ProfileRepository)->getProfileData()['data']['force_screen_width'] ?? 0;
        $layouts = [
            0 => [
                'icon' => 'fas fa-laptop-code',
                'label' => 'auto'
            ],
            1600 => [
                'icon' => 'fas fa-desktop',
                'label' => 'large1600'
            ],
            1000 => [
                'icon' => 'fas fa-tablet-alt',
                'label' => 'medium1000'
            ],
            700 => [
                'icon' => 'fas fa-mobile-alt',
                'label' => 'small700'
            ],
        ];
        if (isset($layouts[$width])) {
            $layouts[$width]['active'] = true;
        }
        return $layouts;
    }
}
