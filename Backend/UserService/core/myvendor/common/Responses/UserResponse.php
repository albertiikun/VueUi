<?php

namespace Core\myvendor\common\Responses;

class UserResponse
{
    public static function SuccessCreate()
    {
        return response('User is created successfully', 200);
    }

    public static function SuccessUpdate()
    {
        return response('User is updated successfully', 200);
    }

    public static function SuccessDelete()
    {
        return response('User is deleted successfully', 200);
    }

    public static function SuccessDeactivate()
    {
        return response('User is deactivated successfully', 200);
    }

    public static function SuccessUndelete()
    {
        return response('User is undeleted successfully', 200);
    }


    public static function UserNotFound()
    {
        return response('User is not registred on our platform!', 404);
    }

    public static function EmailNotFound($email)
    {
        return response($email . ' is not found in our platform!', 404);
    }

    public static function CurrentPasswordInvalid()
    {
        return response('Current password is not valid!', 400);
    }
}
