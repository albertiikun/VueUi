<?php

namespace Functional\user\commands\updatePassword;

use Core\myvendor\common\Exceptions\NoPermissionException;
use Core\myvendor\functions\auth\ThisAuth;
use Domain\entities\UserRole;

trait CanUpdatePassword
{

    private function CanUpdateUserPassword($userId)
    {
        if ($userId === ThisAuth::Id()) {
            return;
        }

        $roles = UserRole::where('user_id', $userId)
            ->leftJoin('roles', 'roles.id', '=', 'user_roles.role_id')
            ->pluck('roles.name');
        if (count($roles) == 0) {
            return;
        }

        $permission = "";

        foreach ($roles as $role) {
            $permission .= strtolower('edit-password ' . $role . '|');
        }

        $permission = rtrim($permission, "|");

        if (ThisAuth::HasPermissions($permission)) {
            return;
        }
        throw new NoPermissionException();
    }
}
