<?php

namespace Functional\user\commands\delete;

use Core\myvendor\common\Responses\UserResponse;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\User;
use Illuminate\Http\Request;

class DeleteHandler implements IMeteorHandler
{
    use CanDelete;

    public function __construct()
    {
    }

    public function Handler(Request $request)
    {
        $this->CanDeleteUser($request->id);

        $this->DeleteUser($request->id);

        return UserResponse::SuccessDeactivate();
    }

    public function DeleteUser($id)
    {
        User::find($id)->delete();
    }
}
