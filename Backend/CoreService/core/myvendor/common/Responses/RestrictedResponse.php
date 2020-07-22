<?php
namespace Core\myvendor\common\Responses;

class RestrictedResponse
{
    public static function SuccessRestricted()
    {
        return response('User is restricted successfully', 200);
    }
}
