<?php

namespace Functional\user\commands\undelete;

use Core\myvendor\common\Responses\UserResponse;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Illuminate\Http\Request;

class UndeleteHandler implements IMeteorHandler
{
    use UndeleteModels, CanUndelete;

    public function Handler(Request $request)
    {
        $this->CanUndeleteUser($request->id);

        $this->Undelete($request->id);

        return UserResponse::SuccessUndelete();
    }
}
