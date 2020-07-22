<?php

namespace Functional\user\queries\getDeleted;

use Core\myvendor\common\Exceptions\NoPermissionException;
use Core\myvendor\functions\auth\ThisAuth;
use Domain\entities\Role;
use Illuminate\Http\Request;

trait CanGetDeletedUsers
{

    private function CanGetDeletedUsers(Request $request)
    {

        $permissions = ThisAuth::PermissionsName();

        if (count($permissions) == 0) {
            throw new NoPermissionException();
        }

        $getPermissions = [];

        for ($i = 0; $i < count($permissions); $i++) {
            if (strpos($permissions[$i], 'get-deactivated') !== false) {
                array_push($getPermissions, $permissions[$i]);
            }
        }

        if (count($getPermissions) == 0) {
            throw new NoPermissionException();
        }

        $roleName = [];

        foreach ($getPermissions as $key => $permission) {
            $data = str_replace('get-deactivated ', '', $permission);
            $upperData = ucfirst($data);
            array_push($roleName, $upperData);
        }


        return Role::whereIn('roles.name', $roleName)
            ->leftJoin('user_roles', 'user_roles.role_id', '=', 'roles.id')
            ->leftJoin('users', 'users.id', '=', 'user_roles.user_id')
            ->leftJoin('core_service.cities as cities', 'users.city_id', '=', 'cities.id')
            ->whereNotNull('users.deleted_at')
            ->whereNotNull('users.id')
            ->select(
                'users.id',
                'users.email',
                'users.name',
                'users.lastName',
                'users.birthDate',
                'users.phoneNumber',
                'users.userName',
                'users.confirmed',
                'users.created_at',
                'roles.name as role',
                'cities.name as city'
            )
            ->where(function ($query) use ($request) {
                $query->where('users.email', 'like', "%{$request->search}%")
                    ->orWhere('users.name', 'like', "%{$request->search}%")
                    ->orWhere('users.lastName', 'like', "%{$request->search}%")
                    ->orWhere('roles.name', 'like', "%{$request->search}%")
                    ->orWhere('cities.name', 'like', "%{$request->search}%");
            })
            ->orderBy("users.deleted_at")
            ->paginate($request->itemsPerPage);
    }
}
