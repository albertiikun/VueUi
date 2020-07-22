<?php

namespace Functional\own\queries\requestConfirmEmail;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RequestConfirmEmailHandler implements IMeteorHandler
{
    use RequestConfirmEmailInsert;

    public function Handler(Request $request)
    {
        $user = $this->BeforeInserted($request);
        $token = $this->Insert($request);
        $getToken = $this->EncryptTokenUrl($token);
        dispatch(new RequestConfirmEmailJob($getToken, $user));

        return response('Link to confirm email is sent successfuly', 200);

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
