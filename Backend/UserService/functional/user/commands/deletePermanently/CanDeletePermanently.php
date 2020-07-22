<?php

namespace Functional\user\commands\deletePermanently;

use Core\myvendor\common\Exceptions\NoPermissionException;
use Core\myvendor\functions\auth\ThisAuth;
use Domain\entities\UserRole;

trait CanDeletePermanently
{

    private function CanDeletePermanentlyUser($userId)
    {

        $roles = UserRole::where('user_id', $userId)
            ->leftJoin('roles', 'roles.id', '=', 'user_roles.role_id')
            ->pluck('roles.name');

        if (count($roles) == 0) {
            return;
        }

        $permission = "";

        foreach ($roles as $role) {
            $permission .= strtolower('delete ' . $role . '|');
        }

        $permission = rtrim($permission, "|");

        if (ThisAuth::HasPermissions($permission)) {
            return;
        } else {
            throw new NoPermissionException();
        }
    }
}
