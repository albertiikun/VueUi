<?php

namespace Functional\user\commands\deletePermanently;

use Core\myvendor\common\Responses\UserResponse;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\User;
use Illuminate\Http\Request;

class DeletePermanentlyHandler implements IMeteorHandler
{

    use CanDeletePermanently;

    public function Handler(Request $request)
    {
        $this->CanDeletePermanentlyUser($request->id);

        $this->DeleteUser($request->id);

        return UserResponse::SuccessDelete();
    }

    public function DeleteUser($id)
    {
        User::withTrashed()->findOrFail($id)->forceDelete();
    }
}
