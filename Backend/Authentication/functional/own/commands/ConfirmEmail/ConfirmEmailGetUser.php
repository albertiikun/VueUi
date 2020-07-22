<?php

namespace Functional\own\commands\ConfirmEmail;

use Carbon\Carbon;
use Core\myvendor\common\Exceptions\EmailConfirmExpireTokenException;
use Core\myvendor\common\Exceptions\EmailNotFoundException;

trait ConfirmEmailGetUser
{
    use ConfirmEmailModel;

    private function GetEmail($token)
    {
        $reset = $this->_model::where('revoked', false)
            ->where('token', $token)->first();

        if (!$reset) {
            throw new EmailNotFoundException();
        }

        if ($reset->created_at < Carbon::now()->subHours(1)) {
            throw new EmailConfirmExpireTokenException;
        }

        $this->RevokeToken($reset);

        return $reset->pluck('email');
    }

    private function RevokeToken($reset)
    {
        $reset->update(['revoked' => true, 'status' => true]);
    }
}
