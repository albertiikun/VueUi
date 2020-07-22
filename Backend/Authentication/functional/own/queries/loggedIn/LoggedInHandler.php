<?php

namespace Functional\own\queries\loggedIn;

use Core\myvendor\functions\meteor\IMeteorHandler;
use DeviceDetector\DeviceDetector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedInHandler implements IMeteorHandler
{
    public function Handler(Request $request)
    {
        $userAgent = $request->userAgent();
        $info = new DeviceDetector($userAgent);
        $info->parse();

        dispatch(new LoggedInJob($request->ip(), Auth::user()->id, $info->getClient(), $info->getOs()));

        return;
    }
}
