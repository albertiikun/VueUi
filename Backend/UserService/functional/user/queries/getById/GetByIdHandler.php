<?php

namespace Functional\user\queries\getById;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Illuminate\Http\Request;

class GetByIdHandler implements IMeteorHandler
{
    use CanGetThisUser;

    public function Handler(Request $request)
    {
        return $this->CanGetThisUser($request->id);
    }
}
