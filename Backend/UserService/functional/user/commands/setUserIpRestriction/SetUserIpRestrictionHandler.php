<?php

namespace Functional\user\commands\setUserIpRestriction;

use Core\myvendor\common\Responses\RestrictedResponse;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Illuminate\Http\Request;

class SetUserIpRestrictionHandler implements IMeteorHandler
{
    use CanSetUserIpRestriction, SetUserIpRestrictionModels;

    public function Handler(Request $request)
    {
        // $this->CanSetUserIpRestriction($request->id);

        $this->insertRestriction($request->id, $request->ip);

        return RestrictedResponse::SuccessRestricted();
    }
}
