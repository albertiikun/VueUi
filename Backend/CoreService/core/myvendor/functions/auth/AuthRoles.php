<?php

namespace Core\myvendor\functions\auth;

use Core\myvendor\common\Exceptions\NoPermissionException;
use Domain\entities\Role;
use Domain\entities\UserRole;

trait AuthRoles
{
    public static function RolesName()
    {
        return UserRole::where('user_id', AUTH_USER_ID)
            ->leftJoin('roles', 'roles.id', '=', 'user_roles.role_id')->pluck('roles.name');
    }

    public static function RolesId()
    {
        return UserRole::where('user_id', AUTH_USER_ID)
            ->leftJoin('roles', 'roles.id', '=', 'user_roles.role_id')->pluck('roles.id');
    }

    public static function HasRoles(string $data)
    {
        $datas = explode('|', $data);

        $roles = UserRole::where('user_id', AUTH_USER_ID)
            ->leftJoin('roles', 'roles.id', '=', 'user_roles.role_id')->pluck('roles.name')->toArray();

        foreach ($datas as $datas) {
            if (in_array($datas, $roles)) {
                return true;
            }
        }
        return false;
    }

    public static function CanCreateRole($roleId)
    {

        $role = Role::where('id', $roleId)->first();

        $permission = strtolower('create ' . $role->name);

        if (ThisAuth::HasPermissions($permission)) {
            return $role->id;
        }
        throw new NoPermissionException();
    }

    public static function CanUpdateRole($roleId)
    {

        $role = Role::where('id', $roleId)->first();
        $permission = strtolower('update ' . $role->name);

        if (ThisAuth::HasPermissions($permission)) {
            return $role->id;
        }
        throw new NoPermissionException();
    }

    public static function CanDeleteRole($roleId)
    {

        $role = Role::where('id', $roleId)->first();
        $permission = strtolower('delete ' . $role->name);

        if (ThisAuth::HasPermissions($permission)) {
            return $role->id;
        }
        throw new NoPermissionException();
    }
}
