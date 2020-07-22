<?php

namespace Functional\role\queries\getRolePermissions;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Role;

class GetRolePermissionsHandler implements IMeteorHandler
{
    private $_roleModel;

    public function __construct()
    {
        $this->_roleModel = new Role();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        return $this->_roleModel->where('roles.id', $request->id)
            ->leftJoin('role_has_permissions as rhp', 'rhp.role_id', '=', 'roles.id')
            ->leftJoin('permissions', 'permissions.id', '=', 'rhp.permission_id')
            ->whereNotNull('permissions.id')
            ->orderBy('permissions.name')
            ->get();
    }
}
