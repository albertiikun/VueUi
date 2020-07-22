<?php

namespace Functional\own\queries\forgotPassword;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ForgotPasswordHandler implements IMeteorHandler
{
    use ForgotPasswordInsert;

    public function Handler(Request $request)
    {

        $user = $this->BeforeInserted($request);

        $token = $this->Insert($request);

        $setToken = $this->EncryptTokenUrl($token);

        dispatch(new ForgotPasswordJob($setToken, $user));

        return response('Verification Email is sent successfuly', 200);
    }

    private function PrepareToken()
    {
        return Str::random(64);
    }

    private function EncryptTokenUrl($token)
    {
        return encrypt($token);
    }
}
