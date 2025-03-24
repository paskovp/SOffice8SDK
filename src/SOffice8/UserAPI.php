<?php

namespace Stepsoft\Soffice8sdk\SOffice8;

use Stepsoft\Soffice8sdk\SOfficeRequest as Client;
use Illuminate\Support\Facades\URL;

class UserAPI extends BaseAPI
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
     * Returns all roles in the system
     * @return type
     */
    public function allRoles()
    {
        $response = $this->client->sendRequest('administration/roles', 'GET');
        return $this->validate($response);
    }

    /**
     * Returns all users in the system
     * @return type
     */
    public function getAllUsers()
    {
        $response = $this->client->sendRequest('administration/users', 'GET');
        return $this->validate($response);
    }

    /**
     * Create new user
     * @return type
     */

    public function createUser()
    {
        $response = $this->client->sendRequest('administration/users/create', 'GET');
        $response['data']['employees'] = [];
        if (old('id_nmcl_employees')) {
            $response['data']['employees'] = array_pluck(json_decode($this->employees(old('id_nmcl_employees')), true), 'text', 'id');
        }
        return $this->validate($response);
    }


     /**
     * Edit user data
     * @return type
     */
    public function editUser($id)
    {
        $response = $this->client->sendRequest('administration/users/edit/' . $id, 'GET');
        $response['data']['employees'] = [];
        if (isset($response['data']['user']['id_nmcl_employees']) || old('id_nmcl_employees')) {
            $response['data']['employees'] = array_pluck(json_decode($this->employees(old('id_nmcl_employees') ?? $response['data']['user']['id_nmcl_employees'] ?? null), true), 'text', 'id');
        }
        return $this->validate($response);
    }


    /**
     * Store new user
     * @return type
     */
    public function storeUser($data)
    {
        $data['resetURL'] = URL::to('/resetPassword');
        $response = $this->client->sendRequest('administration/users/store', 'POST', $data);
        return $this->validate($response);
    }

    /**
     * Store edit user data
     * @return type
     */
    public function updateUser($data)
    {
        $response = $this->client->sendRequest('administration/users/update', 'POST', $data);
        return $this->validate($response);
    }

    /**
     * Change user state
     * @return type
     */
    public function active($id)
    {
        $response = $this->client->sendRequest('administration/users/active/' . $id, 'GET');
        return $this->validate($response);
    }

    /**
     * Check user state
     * @return type
     */
    public function checkSession()
    {
        $response = $this->client->sendRequest('/administration/users/checkSession/', 'GET');
        return $this->validate($response);
    }

    public function logout()
    {
        //\Log::error('Logout in UserAPI');
        $response = $this->client->sendRequest('/logout', 'GET');
        return $this->validate($response);
    }

    /**
     * Employee search AJAX JSON result
     */
    public function employees($id = null)
    {
        $search = \Request::input('q') ?? '';
        $employees = [];
        try {
            $url = "/nmcl?nmcl_label=companyEmployees&per_page=100";
            $url .= ($id) ? "&search-0=$id" : "&allsearch=" . urlencode($search);
            $response = $this->client->sendRequest($url, 'GET');
            $response = $response['data']['data'] ?? [];
            foreach ($response as $ri => $employee) {
                $employeeData = [
                    'id' => $employee['id'],
                    'text' => $employee['n_fullName'],
                ];
                preg_match("|^.*?_companyName$|mi", implode("\r\n", array_keys($employee)), $m);
                if (isset($m[0]) && isset($employee[$m[0]])) {
                    $employeeData['text'] .= (' / ' . $employee[$m[0]]);
                }
                $employees[] = $employeeData;
            }
        } catch (\Exception $e) {
            throw $e;
            \Log::error(['UserRepository@employees', $e->getMessage()]);
        }
        return json_encode($employees);
    }
}
