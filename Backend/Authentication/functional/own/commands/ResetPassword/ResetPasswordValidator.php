<?php
namespace Functional\own\commands\ResetPassword;

use Core\myvendor\common\Regex\UserRegex;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class ResetPasswordValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {
       return  $this->validate($request, [
            'password' => ['required', 'min:8', UserRegex::PasswordRegex(), 'confirmed'],
            'token' => ['required'],
        ]);
    }
}
