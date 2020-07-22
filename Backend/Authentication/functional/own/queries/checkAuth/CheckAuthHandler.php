<?php

namespace Functional\own\queries\checkAuth;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuthHandler implements IMeteorHandler
{
    public function Handler(Request $request)
    {
        return response(['id' => Auth::id(), 200]);
    }
}
