<?php

namespace Host\controllers;

use Host\controllers\base\Controller;
use Host\controllers\base\GuzzleHttp;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    use GuzzleHttp;

    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('devApi.services.group');
    }

    public function Get(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/groups/', $request);
    }

    public function AddUser(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/groups/:add-user', $request);
    }

    public function GetUsersByGroupId(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/groups/:users-group-id', $request);
    }

    public function CreateGroup(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/groups/:create', $request);
    }

    public function CheckGroupNameExist(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/groups/:check-group-name', $request);
    }

    public function GetGroupSubjects(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/groups/:group-sujects', $request);
    }

    public function GetUsersToAssign(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/groups/:users-to-assign', $request);
    }

    public function UnassignUser(Request $request)
    {
        return $this->httpDelete($this->baseUrl, 'api/groups/:unassign-user', $request);
    }

    public function ActiveGroup(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/groups/:active-group', $request);
    }

    public function GetActivatedGroups(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/groups/:actvated-groups', $request);
    }

    public function ActiveUser(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/groups/:active-user', $request);
    }

    public function GetActivatedUsers(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/groups/:activated-users', $request);
    }

    public function UnactiveUser(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/groups/:unactive-user', $request);
    }

    public function DeactivateGroup(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/groups/:deactivate-group', $request);
    }

    public function UpdateGroup(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/groups/:update', $request);
    }

    public function UpdateGroupLevel(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/groups/:update-group-level', $request);
    }
}
