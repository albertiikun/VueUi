<?php

namespace Functional\role\commands\update;

use Core\myvendor\functions\auth\ThisAuth;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Illuminate\Http\Request;

class UpdateHandler implements IMeteorHandler
{
    use UpdateRole;

    public function Handler(Request $request)
    {
        ThisAuth::HasPermissionsOrDie('update roles');

        $this->UpdateRole($request);


        return response(null, 200);
    }
}
