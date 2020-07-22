<?php

namespace Functional\user\commands\register;

use Core\myvendor\common\Regex\UserRegex;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class RegisterValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {
        return $this->validate($request, [
            'name' => ['required', 'string', 'min:2', 'max:50'],
            'lastName' => ['required', 'string', 'min:2', 'max:50'],
            'phoneNumber' => ['required'],
            'birthDate' => ['required'],
            'city_id' => ['required', 'string', 'uuid'],
            'userName' => ['required', 'unique:users,userName', 'string', 'max:100'],
            'role_id' => ['required', 'uuid', 'exists:roles,id'],
            'email' => ['required', 'unique:users,email,', 'email', 'max:100'],
            'password' => ['required', 'string', 'confirmed', 'min:8', 'max:100', UserRegex::PasswordRegex()],
            'password_confirmation' => ['required'],
        ]);
    }
}
