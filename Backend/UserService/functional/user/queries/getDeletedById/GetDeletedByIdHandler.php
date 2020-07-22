<?php

namespace Functional\user\queries\getDeletedById;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Illuminate\Http\Request;

class GetDeletedByIdHandler implements IMeteorHandler
{
    use CanGetDeletedThisUser;

    public function Handler(Request $request)
    {
        return $this->CanGetDeletedThisUser($request->id);

    }
}
