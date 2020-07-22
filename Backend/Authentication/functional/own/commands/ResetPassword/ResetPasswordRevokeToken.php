<?php

namespace Functional\own\commands\ResetPassword;

trait ResetPasswordRevokeToken
{
    private function RevokeToken($reset)
    {
        $reset->update(['revoked' => true, 'status' => true]);
    }
}
