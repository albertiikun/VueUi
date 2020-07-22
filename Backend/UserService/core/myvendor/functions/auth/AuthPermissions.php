<?php

namespace Core\myvendor\functions\auth;

use Core\myvendor\common\Exceptions\NoPermissionException;
use Domain\entities\UserRole;

trait AuthPermissions
{

    public static function PermissionsName()
    {
        return UserRole::where('user_id', AUTH_USER_ID)
            ->leftJoin('roles', 'roles.id', '=', 'user_roles.role_id')
            ->leftJoin('role_has_permissions as rhp', 'rhp.role_id', '=', 'roles.id')
            ->leftJoin('permissions', 'permissions.id', '=', 'rhp.permission_id')->pluck('permissions.name');
    }

    public static function HasPermissions(string $data)
    {
        $datas = explode('|', $data);

        $permissions = UserRole::where('user_id', AUTH_USER_ID)
            ->leftJoin('roles', 'roles.id', '=', 'user_roles.role_id')
            ->leftJoin('role_has_permissions as rhp', 'rhp.role_id', '=', 'roles.id')
            ->leftJoin('permissions', 'permissions.id', '=', 'rhp.permission_id')->pluck('permissions.name')->toArray();

        $permissions = array_map('strtolower', $permissions);

        foreach ($datas as $permission) {
            if (in_array(strtolower($permission), $permissions)) {
                return true;
            }
        }
        return false;
    }

    public static function HasPermissionsOrDie(string $data)
    {
        $datas = explode('|', $data);

        $permissions = UserRole::where('user_id', AUTH_USER_ID)
            ->leftJoin('roles', 'roles.id', '=', 'user_roles.role_id')
            ->leftJoin('role_has_permissions as rhp', 'rhp.role_id', '=', 'roles.id')
            ->leftJoin('permissions', 'permissions.id', '=', 'rhp.permission_id')->pluck('permissions.name')->toArray();

        $permissions = array_map('strtolower', $permissions);

        foreach ($datas as $permission) {
            if (in_array(strtolower($permission), $permissions)) {
                return true;
            }
        }
        throw new NoPermissionException();
    }
}
