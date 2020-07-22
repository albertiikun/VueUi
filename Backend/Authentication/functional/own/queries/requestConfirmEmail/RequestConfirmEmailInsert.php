<?php

namespace Functional\own\queries\requestConfirmEmail;

use Core\myvendor\common\Exceptions\EmailNotFoundException;
use Illuminate\Http\Request;

trait RequestConfirmEmailInsert
{
    use RequestConfirmEmailModel;

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
