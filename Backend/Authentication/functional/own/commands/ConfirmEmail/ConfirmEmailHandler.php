<?php

namespace Functional\own\commands\ConfirmEmail;

use Core\myvendor\common\Exceptions\InvalidTokenException;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Illuminate\Http\Request;

class ConfirmEmailHandler implements IMeteorHandler
{
    use ConfirmEmailModel, ConfirmEmailGetUser, ConfirmEmailUpdate;

    public function Handler(Request $request)
    {
        $token = $this->PrepareToken($request->token);
        $email = $this->GetEmail($token);
        return $this->Update($email, $request);
    }

    private function PrepareToken($token)
    {
        try {
            return decrypt($token);

        } catch (\Throwable $th) {
            throw new InvalidTokenException();
        }
    }
}
