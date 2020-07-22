<?php

namespace Functional\user\queries\getUsernameAndEmailById;

use Core\myvendor\common\Exceptions\NoPermissionException;
use Core\myvendor\functions\auth\ThisAuth;
use Domain\entities\User;
use Domain\entities\UserRole;

trait CanGetUsernameAndEmailById
{
    private function CanGetUsernameAndEmailById($userId)
    {
        if (ThisAuth::CheckIsMe($userId)) {
            return ThisAuth::User();
        }

        $roles = UserRole::where('user_id', $userId)
            ->leftJoin('roles', 'roles.id', '=', 'user_roles.role_id')
            ->pluck('roles.name');

        if (count($roles) == 0) {
            return;
        }

        $permission = "";

        foreach ($roles as $role) {
            $permission .= strtolower('get ' . $role . '|');
        }

        $permission = rtrim($permission, "|");

        if (ThisAuth::HasPermissions($permission)) {
            return $this->UserById($userId);
        }
        throw new NoPermissionException();
    }

    private function UserById($userId)
    {
        return User::where('id', $userId)->select('userName', 'email')->first();
    }
}
