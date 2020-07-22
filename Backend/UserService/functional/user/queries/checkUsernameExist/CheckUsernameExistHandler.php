<?php

namespace Functional\user\queries\checkUsernameExist;

use Core\myvendor\functions\meteor\IMeteorHandler;

class CheckUsernameExistHandler implements IMeteorHandler
{
    public function Handler(\Illuminate\Http\Request $request)
    {
        return response(null, 200);
    }
}
