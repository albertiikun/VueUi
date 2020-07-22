<?php

namespace Core\myvendor\common\Regex;

class UserRegex
{

    public static function PasswordRegex()
    {
        return 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/';
    }
}
