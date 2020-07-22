<?php

namespace Functional\role\commands\delete;

use Core\myvendor\functions\auth\ThisAuth;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Permission;
use Domain\entities\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeleteHandler implements IMeteorHandler
{
    private $_roleModel;
    private $_permissionModel;


    public function __construct()
    {
        $this->_roleModel = new Role;
        $this->_permissionModel = new Permission();
    }

    public function Handler(Request $request): Response
    {
        ThisAuth::HasPermissionsOrDie('manage-roles');

        $this->_roleModel = $this->_roleModel->where('id', $request->role_id)->first();

        $this->RemovePermissions($this->_roleModel->name);

        $this->_roleModel->delete();

        return response('Role is deleted successfully', 200);
    }

    private function RemovePermissions($roleName)
    {
        $this->_permissionModel->where('roleRefs', $roleName)->delete();
    }
}
