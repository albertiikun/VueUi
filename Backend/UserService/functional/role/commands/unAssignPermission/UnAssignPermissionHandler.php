<?php

namespace Functional\role\commands\unAssignPermission;

use Core\myvendor\common\Exceptions\PermissionIsAlreadyUnAssignedException;
use Core\myvendor\functions\auth\ThisAuth;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\RoleHasPermission;

class UnAssignPermissionHandler implements IMeteorHandler
{
    private $_roleHasPermissionModel;

    public function __construct()
    {
        $this->_roleHasPermissionModel = new RoleHasPermission();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        ThisAuth::HasPermissionsOrDie('manage-roles');
        
        $permission =  $this->_roleHasPermissionModel
            ->where('role_id', $request->role_id)
            ->where('permission_id', $request->permission_id);

        if ($permission->count() == 0)
            throw new PermissionIsAlreadyUnAssignedException();

        $permission->delete();

        return response('Permission in unassigned successfully', 200);
    }
}
