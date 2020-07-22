<?php

namespace Functional\user\queries\getDeleted;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\User;
use Illuminate\Http\Request;

class GetDeletedHandler implements IMeteorHandler
{
    use CanGetDeletedUsers;

    public function Handler(Request $request)
    {
        return response(
            [
                'users' => $this->CanGetDeletedUsers($request),
                'usersLength' => User::onlyTrashed()->count()
            ]
        );
    }
}
