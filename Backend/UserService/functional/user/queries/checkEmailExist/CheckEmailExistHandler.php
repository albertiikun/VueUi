<?php

namespace Functional\user\queries\checkEmailExist;

use Core\myvendor\functions\meteor\IMeteorHandler;

class CheckEmailExistHandler implements IMeteorHandler
{
    public function Handler(\Illuminate\Http\Request $request)
    {
        return response(null, 200);
    }
}
