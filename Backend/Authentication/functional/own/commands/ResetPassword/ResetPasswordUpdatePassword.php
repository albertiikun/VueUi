<?php

namespace Functional\own\commands\ResetPassword;

use Core\myvendor\common\Exceptions\InvalidTokenException;
use Domain\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

trait ResetPasswordUpdatePassword
{

    private function UpdatePassword($email, Request $request)
    {
        $user = User::where('email', $email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        if (!$user) {
            throw new InvalidTokenException();
        }

        return response('Password has been changed successfuly', 200);
    }
}
