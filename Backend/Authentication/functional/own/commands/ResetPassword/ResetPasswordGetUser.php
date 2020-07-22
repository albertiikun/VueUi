<?php

namespace Functional\own\commands\ResetPassword;

use Carbon\Carbon;
use Core\myvendor\common\Exceptions\EmailNotFoundException;
use Core\myvendor\common\Exceptions\ResetPasswordExpireTokenException;
use Domain\Entities\PasswordReset;

trait ResetPasswordGetUser
{
    use ResetPasswordRevokeToken;

    private function GetEmail($token)
    {
        $reset = PasswordReset::where('revoked', false)
            ->where('token', $token)->latest('created_at')->first();

        if (!$reset) {
            throw new EmailNotFoundException();
        }

        if ($reset->created_at < Carbon::now()->subHours(1)) {
            throw new ResetPasswordExpireTokenException();
        }


        $email = $reset->email;

        $this->RevokeToken($reset);

        return $email;
    }
}
