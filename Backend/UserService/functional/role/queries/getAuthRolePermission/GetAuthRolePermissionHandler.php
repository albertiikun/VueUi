<?php

namespace Functional\role\queries\getAuthRolePermission;

use Core\myvendor\functions\auth\ThisAuth;
use Core\myvendor\functions\meteor\IMeteorHandler;

class GetAuthRolePermissionHandler implements IMeteorHandler
{

    public function Handler(\Illuminate\Http\Request $request)
    {
        return ThisAuth::PermissionsName();
    }
}
