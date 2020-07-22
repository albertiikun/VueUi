<?php

namespace Functional\role\queries\getRoleNoPermissions;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Permission;
use Domain\entities\Role;

class GetRoleNoPermissionsHandler implements IMeteorHandler
{
    private $_permissionModel;
    private $_roleModel;

    public function __construct()
    {
        $this->_permissionModel = new Permission();
        $this->_roleModel = new Role();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        $permissionsId =  $this->_roleModel->where('roles.id', $request->id)
            ->leftJoin('role_has_permissions as rhp', 'rhp.role_id', '=', 'roles.id')
            ->leftJoin('permissions', 'permissions.id', '=', 'rhp.permission_id')
            ->whereNotNull('permissions.id')
            ->pluck('permissions.id');

        return $this->_permissionModel->whereNotIn('id', $permissionsId)->orderBy('name')->get();
    }
}
