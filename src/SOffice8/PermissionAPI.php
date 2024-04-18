<?php

namespace Stepsoft\Soffice8sdk\SOffice8;

use Stepsoft\Soffice8sdk\SOfficeRequest as Client;

class PermissionAPI extends BaseAPI
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
     * Sends a request to the server to response the role settings
     * @param type $roleId
     * @return type
     */
    public function getEditRole($roleId)
    {
        $response = $this->client->sendRequest('administration/roles/' . $roleId, 'GET');
        return $this->validate($response);
    }

    /**
     * Sends a request to the server to delete a role
     * @param type $roleId
     * @return type
     */
    public function deleteRole($roleId)
    {
        $response = $this->client->sendRequest('administration/roles/' . $roleId . '/delete', 'GET');
        return $this->validate($response);
    }

    /**
     * Sends a request to the server to response the role permissions 
     * @param type $roleId
     * @return type
     */
    public function getEditRolePermissions($roleId)
    {
        $response = $this->client->sendRequest('administration/permissions/' . $roleId, 'GET');
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
     * Returns all roles of given user
     * @param type $userId
     * @return type
     */
    public function getUserRolesById($userId)
    {
        $response = $this->client->sendRequest('administration/users/' . $userId, 'GET');
        return $this->validate($response);
    }

    /**
     * Saving given role's permissions
     * @param type $roleId
     * @param type $permissions
     * @return type
     */
    public function saveRolePermissions($roleId, $permissions)
    {
        $response = $this->client->sendRequest('administration/permissions/store/' . $roleId, 'POST', ['permissions' => $permissions]);
        return $this->validate($response);
    }

    /**
     * Creating a new role
     * @param type $roleName
     * @param type $roleComment
     * @param type $roleId
     * @return type
     */
    public function store($roleName, $roleComment, $roleId = null)
    {
        $response = $this->client->sendRequest('administration/roles', 'POST', [
            'name' => $roleName,
            'comment' => $roleComment,
            'id' => $roleId
        ]);
        return $this->validate($response);
    }

    /**
     * Getting all user's personal permissions
     * @param type $userId
     * @return type
     */
    public function getPersonalPermissions($userId)
    {
        $response = $this->client->sendRequest('administration/users/' . $userId . '/personal', 'GET');
        return $this->validate($response);
    }

    /**
     * Saving the new user personal permissions
     * @param type $userId
     * @param type $newPersonalPermissions
     * @return type
     */
    public function saveUserPersonalPermissions($userId, $newPersonalPermissions)
    {
        $response = $this->client->sendRequest('administration/users/' . $userId . '/personal', 'POST', [
            'newPermissions' => $newPersonalPermissions
        ]);
        return $this->validate($response);
    }

    /**
     * Adding a new personal permission to the user
     * @param type $userId
     * @param type $id_resource
     * @param type $is_allowed
     * @return type
     */
    public function addNewPersonalPermission($userId, $id_resource, $is_allowed)
    {
        $response = $this->client->sendRequest('administration/users/' . $userId . '/personal/add', 'POST', [
            'id_resource' => $id_resource,
            'is_allowed' => $is_allowed
        ]);
        return $this->validate($response);
    }

    /**
     * Sends a request to the server to return form by its ID
     * @param type $id
     * @return type
     */
    //    public function getForm($id) {
    //        $response = $this->client->sendRequest('ui/form/' . $id, 'GET');
    //        return $this->validate($response);
    //    }

    /**
     * Sends a request to the server to update user roles
     * @param type $id_user
     * @param type $roles
     * @return type
     */
    public function updateUserRoles($id_user, $roles)
    {
        $response = $this->client->sendRequest('administration/users/' . $id_user . '/roles', 'POST', ['roles' => $roles]);
        return $this->validate($response);
    }

    /**
     * Sends a request to the server to remove user's personal permission/restriction
     * @param type $id_user
     * @param type $id_resource
     * @return type
     */
    public function deletePersonalPermission($id_user, $id_resource)
    {
        $response = $this->client->sendRequest('/administration/users/' . $id_user . '/personal/' . $id_resource . '/delete', 'GET');
        return $this->validate($response);
    }
}
