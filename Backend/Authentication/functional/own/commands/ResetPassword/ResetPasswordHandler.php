<?php

namespace Functional\own\commands\ResetPassword;

use Core\myvendor\common\Exceptions\InvalidTokenException;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\Entities\PasswordReset;
use Domain\Entities\User;
use Illuminate\Http\Request;

class ResetPasswordHandler implements IMeteorHandler
{
    use ResetPasswordGetUser, ResetPasswordUpdatePassword;

    public function Handler(Request $request)
    {
        $token = $this->PrepareToken($request->token);
        $email = $this->GetEmail($token);
        return $this->UpdatePassword($email, $request);
    }

    private function PrepareToken($token)
    {
        try {
            return decrypt($token);
        } catch (\Throwable $th) {
            throw new InvalidTokenException;
        }
    }
}
