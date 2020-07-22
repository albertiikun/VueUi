<?php

namespace Functional\user\commands\updatePassword;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

trait UpdatePasswordCheckHashes
{

    protected function checkOldPasswordHash($requestPassword, $oldPassword)
    {
        $isValid = Hash::check($requestPassword, $oldPassword);

        if ($isValid) {
            return true;
        } else {
            return false;
        }
    }
}
