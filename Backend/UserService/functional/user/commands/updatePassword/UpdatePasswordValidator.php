<?php

namespace Functional\user\commands\updatePassword;

use Core\myvendor\common\Regex\UserRegex;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class UpdatePasswordValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {
        return $this->validate($request, [
            'oldPassword' => ['required', 'min:8', UserRegex::PasswordRegex()],
            'password' => ['required', 'min:8', UserRegex::PasswordRegex(), 'confirmed'],
            'id' => ['required', 'uuid', 'exists:users,id,deleted_at,NULL'],
        ]);
    }
}
