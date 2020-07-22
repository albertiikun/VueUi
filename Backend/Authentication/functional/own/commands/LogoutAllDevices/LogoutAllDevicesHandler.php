<?php

namespace Functional\own\commands\LogoutAllDevices;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogoutAllDevicesHandler implements IMeteorHandler
{
    public function Handler(Request $request)
    {
        $result = DB::table('oauth_access_tokens')
            ->where('user_id', Auth::user()->id)
            ->update(['revoked' => true]);

        if (!$result) {
            return response('Cannot logged out on all devices', 500);
        }

        return response('Successfully loged out on all devices', 200);
    }
}
