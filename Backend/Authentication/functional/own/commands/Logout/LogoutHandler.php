<?php

namespace Functional\own\commands\Logout;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogoutHandler implements IMeteorHandler
{
    public function Handler(Request $request)
    {
        $result = DB::table('oauth_access_tokens')
            ->where('id', Auth::user()->token()->id)
            ->update(['revoked' => true]);

        if (!$result) {
            return response('Cannot logged out', 500);
        }

        return response('Successfully loged out', 200);
    }
}
