<?php
namespace Core\myvendor\common\Responses;

class AuthResponse
{
    public static function NoPermission()
    {
        return response("You don't have permission for this action", 401);
    }
}
