<?php

namespace Functional\user\commands\updatePassword;

use Core\myvendor\common\Responses\UserResponse;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordHandler implements IMeteorHandler
{
    use UpdatePasswordModels, UpdatePasswordCheckHashes, CanUpdatePassword;
    private $_user;

    public function Handler(Request $request)
    {
        $this->CanUpdateUserPassword($request->id);

        $this->_user = $this->getThisUser($request->id);

        $isValid = $this->checkOldPasswordHash($request->oldPassword, $this->_user->password);

        if (!$isValid) {
            return UserResponse::CurrentPasswordInvalid();
        }

        $this->_user->password = Hash::make($request->password);
        $this->_user->save();

        return response('User password is updated successfully', 200);
    }
}
