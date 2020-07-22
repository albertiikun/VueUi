<?php

namespace Host\controllers;

use Host\controllers\base\Controller;
use Host\controllers\base\GuzzleHttp;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use GuzzleHttp;

    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('devApi.services.user');
    }

    public function GetUsers(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/users/', $request);
    }

    public function GetRoles(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/roles/', $request);
    }

    public function RegisterUser(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/users/:register', $request);
    }

    public function CheckEmailExist(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/users/:email', $request);
    }

    public function CheckUsernameExist(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/users/:username', $request);
    }

    public function UpdatePassword(Request $request)
    {
        return $this->httpPut($this->baseUrl, 'api/users/:update-password', $request);
    }

    public function GetUserById(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/users/:id', $request);
    }

    public function GetDeletedUsers(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/users/:deleted', $request);
    }

    public function DeleteUser(Request $request)
    {
        return $this->httpDelete($this->baseUrl, 'api/users/:delete', $request);
    }

    public function UndeleteUser(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/users/:undelete', $request);
    }

    public function DeletePermanently(Request $request)
    {
        return $this->httpDelete($this->baseUrl, 'api/users/:delete-permanently', $request);
    }
    public function UpdateUser(Request $request)
    {
        return $this->httpPut($this->baseUrl, 'api/users/:update', $request);
    }
    public function UpdateUsernameAndEmail(Request $request)
    {
        return $this->httpPut($this->baseUrl, 'api/users/:update-username-email', $request);
    }

    public function GetUsernameAndEmail(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/users/:username-email-id', $request);
    }

    public function GetRolePermissions(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/roles/:has-permissions', $request);
    }

    public function GetRoleNoPermissions(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/roles/:has-not-permissions', $request);
    }

    public function AssignPermission(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/roles/:assign-permission', $request);
    }

    public function UnAssignPermission(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/roles/:unassign-permission', $request);
    }

    public function RegisterRole(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/roles/:register', $request);
    }

    public function DeleteRole(Request $request)
    {
        return $this->httpDelete($this->baseUrl, 'api/roles/:delete', $request);
    }

    public function GetAuthRolePermission(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/roles/:auth-role-permission', $request);
    }
}
