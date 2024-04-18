<?php

namespace Stepsoft\Soffice8sdk\SOffice8;

use Stepsoft\Soffice8sdk\SOfficeRequest as Client;

class RoleAPI extends BaseAPI {

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
    public function allRoles() {
        $response = $this->client->sendRequest('administration/roles', 'GET');
        return $this->validate($response);
    }

    /**
     * Sends a request to the server to response the role settings
     * @param type $roleId
     * @return type
     */
    public function getEditRole($roleId) {
        $response = $this->client->sendRequest('administration/roles/' . $roleId, 'GET');
        return $this->validate($response);
    }
    
    /**
     * Returns all roles of given user
     * @param type $userId
     * @return type
     */
    public function getUserRolesById($userId) {
        $response = $this->client->sendRequest('administration/users/roles/' . $userId, 'GET');
        return $this->validate($response);
    }

    /**
     * Sends a request to the server to update user roles
     * @param type $id_user
     * @param type $roles
     * @return type
     */
    public function updateUserRoles($id_user, $roles) {
        $response = $this->client->sendRequest('administration/users/' . $id_user . '/roles', 'POST', ['roles' => $roles]);
        return $this->validate($response);
    }

    /**
     * Creating a new role
     * @param type $roleName
     * @param type $roleComment
     * @param type $roleId
     * @return type
     */
    public function store($roleName, $roleComment, $roleId = null) {
        $response = $this->client->sendRequest('administration/roles', 'POST', [
            'name' => $roleName,
            'comment' => $roleComment,
            'id' => $roleId
        ]);
        return $this->validate($response);
    }

    /**
     * Sends a request to the server to delete a role
     * @param type $roleId
     * @return type
     */
    public function deleteRole($roleId) {
        $response = $this->client->sendRequest('administration/roles/' . $roleId . '/delete', 'GET');
        return $this->validate($response);
    }

}
