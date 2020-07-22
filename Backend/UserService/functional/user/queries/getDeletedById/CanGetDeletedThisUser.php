<?php

namespace Functional\user\queries\getDeletedById;

use Core\myvendor\common\Exceptions\NoPermissionException;
use Core\myvendor\functions\auth\ThisAuth;
use Domain\entities\User;
use Domain\entities\UserRole;

trait CanGetDeletedThisUser
{

    private function CanGetDeletedThisUser($userId)
    {

        $roles = UserRole::where('user_id', $userId)
            ->leftJoin('roles', 'roles.id', '=', 'user_roles.role_id')
            ->pluck('roles.name');

        if (count($roles) == 0) {
            return;
        }

        $permission = "";

        foreach ($roles as $role) {
            $permission .= strtolower('get-deleted ' . $role . '|');
        }

        $permission = rtrim($permission, "|");

        if (ThisAuth::HasPermissions($permission)) {
            return $this->UserByIdOnlyTrashed($userId);
        }
        throw new NoPermissionException();
    }

    private function UserByIdOnlyTrashed($userId)
    {
        return User::onlyTrashed()->where('id', $userId)->get();
    }
}
