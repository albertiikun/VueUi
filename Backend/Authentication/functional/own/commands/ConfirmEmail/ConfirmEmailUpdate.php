<?php

namespace Functional\own\commands\ConfirmEmail;

use Core\myvendor\common\Exceptions\EmailNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

trait ConfirmEmailUpdate
{
    use ConfirmEmailModel;

    private function Update($email, Request $request)
    {
        $user = $this->_userModel::whereIn('email', $email)->first();
        $user->confirmed = true;
        $user->save();

        if (!$user) {
            throw new EmailNotFoundException();
        }

        return response('Email is verified successfully', 200);
    }
}
