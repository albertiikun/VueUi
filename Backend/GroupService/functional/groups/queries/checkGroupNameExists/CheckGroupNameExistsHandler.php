<?php

namespace Functional\groups\queries\checkGroupNameExists;

use Core\myvendor\functions\meteor\IMeteorHandler;

class CheckGroupNameExistsHandler implements IMeteorHandler
{
    public function Handler(\Illuminate\Http\Request $request)
    {
        return response(null, 200);
    }
}
