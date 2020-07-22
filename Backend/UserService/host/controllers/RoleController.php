<?php

namespace Host\controllers;

use Functional\role\commands\assignPermission\AssignPermissionHandler;
use Functional\role\commands\delete\DeleteHandler;
use Functional\role\commands\register\RegisterHandler;
use Functional\role\commands\unAssignPermission\UnAssignPermissionHandler;
use Functional\role\commands\update\UpdateHandler;
use Functional\role\queries\get\GetHandler;
use Functional\role\queries\getAuthRolePermission\GetAuthRolePermissionHandler;
use Functional\role\queries\getRoleNoPermissions\GetRoleNoPermissionsHandler;
use Functional\role\queries\getRolePermissions\GetRolePermissionsHandler;
use Host\controllers\base\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function Register(RegisterHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function Update(UpdateHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function Delete(DeleteHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function Get(GetHandler $command)
    {
        return $this->_meteor->Send($command);
    }

    public function GetRolePermissions(GetRolePermissionsHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function GetRoleNoPermissions(GetRoleNoPermissionsHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function AssignPermission(AssignPermissionHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function UnAssignPermission(UnAssignPermissionHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function GetAuthRolePermission(GetAuthRolePermissionHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }
}
