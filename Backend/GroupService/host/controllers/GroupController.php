<?php

namespace Host\controllers;

use Functional\groups\commands\activeGroup\ActiveGroupHandler;
use Functional\groups\commands\activeUser\ActiveUserHandler;
use Functional\groups\commands\addUsers\AddUsersHandler;
use Functional\groups\commands\createGroup\CreateGroupHandler;
use Functional\groups\commands\deactivateGroup\DeactivateGroupHandler;
use Functional\groups\commands\unactiveUser\UnactiveUserHandler;
use Functional\groups\commands\unassignUser\UnassignUserHandler;
use Functional\groups\commands\updateGroup\UpdateGroupHandler;
use Functional\groups\commands\updateGroupLevel\UpdateGroupLevelHandler;
use Functional\groups\queries\checkGroupNameExists\CheckGroupNameExistsHandler;
use Functional\groups\queries\getActivatedGroups\GetActivatedGroupsHandler;
use Functional\groups\queries\getActivatedUsers\GetActivatedUsersHandler;
use Functional\groups\queries\getAll\GetAllHandler;
use Functional\groups\queries\getGroupsByUserId\GetGroupsByUserIdHandler;
use Functional\groups\queries\getSubjects\GetSubjectsHandler;
use Functional\groups\queries\getUsersByGroupId\GetUsersByGroupIdHandler;
use Functional\groups\queries\getUsersToAssign\GetUsersToAssignHandler;
use Host\controllers\base\Controller;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    public function Get(GetAllHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function AddUser(AddUsersHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function GetUsersByGroupId(GetUsersByGroupIdHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function CreateGroup(CreateGroupHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function UpdateGroup(UpdateGroupHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function CheckGroupNameExist(CheckGroupNameExistsHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function GetGroupSubjects(GetSubjectsHandler $query)
    {
        return $this->_meteor->Send($query);
    }

    public function GetUsersToAssign(GetUsersToAssignHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function UnassignUser(UnassignUserHandler $command, Request $request)
    {
        return $this->_meteor->send($command, $request);
    }

    public function ActiveGroup(ActiveGroupHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function GetActivatedGroups(GetActivatedGroupsHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function ActiveUser(ActiveUserHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function GetActivatedUsers(GetActivatedUsersHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function UnactiveUser(UnactiveUserHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function DeactivateGroup(DeactivateGroupHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function UpdateGroupLevel(UpdateGroupLevelHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function GetGroupsByUserId(GetGroupsByUserIdHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }
}
