<?php

namespace Functional\user\queries\getAll;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\User;
use Illuminate\Http\Request;

class GetAllHandler implements IMeteorHandler
{
    use CanGetUsers;

    public function Handler(Request $request)
    {
        return response(
            [
                'users' => $this->GetUsers($request),
                'usersLength' => User::all()->count()
            ],
            200
        );
    }
}
