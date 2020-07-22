<?php

namespace Functional\own\queries\forgotPassword;

use Core\myvendor\common\exceptions\EmailNotFoundException;
use Illuminate\Http\Request;

trait ForgotPasswordInsert
{
    use ForgotPasswordModel;

    private function BeforeInserted(Request $request)
    {
        $user = $this->_userModel::where('email', $request->email)->first();

        if (!$user) {
            throw new EmailNotFoundException();
        }

        $this->_model::where('email', $request->email)
            ->update(['revoked' => true]);

        return $user;
    }

    private function Insert(Request $request)
    {
        $token = $this->PrepareToken();
        $model = new $this->_model;
        $model->token = $token;
        $model->email = $request->email;
        $model->status = false;
        $model->revoked = false;
        $model->save();

        return $token;
    }
}
