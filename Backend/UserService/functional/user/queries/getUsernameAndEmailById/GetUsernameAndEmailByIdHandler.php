<?php

namespace Functional\user\queries\getUsernameAndEmailById;

use Core\myvendor\functions\meteor\IMeteorHandler;

class GetUsernameAndEmailByIdHandler implements IMeteorHandler
{
    use CanGetUsernameAndEmailById;

    public function Handler(\Illuminate\Http\Request $request)
    {
        return response($this->CanGetUsernameAndEmailById($request->id), 200);
    }
}
