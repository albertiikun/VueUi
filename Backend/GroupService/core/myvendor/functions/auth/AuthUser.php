<?php

namespace Core\myvendor\functions\auth;

use Domain\entities\User;

trait AuthUser
{
    public static function Id()
    {
        return AUTH_USER_ID;
    }

    public static function User()
    {
        return User::where('id', self::Id())->first();
    }

    public static function CheckIsMe($userId)
    {
        if ($userId == self::Id()) {
            return true;
        } else {
            return false;
        }
    }
}
