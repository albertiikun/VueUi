<?php

namespace Functional\user\commands\updateUsernameAndEmail;

use Core\myvendor\common\Regex\UserRegex;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class UpdateUsernameAndEmailValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'id' => ['required', 'uuid', 'exists:users,id'],
         'email' => ['required', 'unique:users,email,' . $request->id, UserRegex::EmailRegex(), 'max:100'],
         'userName' => ['required', 'unique:users,userName,' . $request->id, UserRegex::UsernameRegex(), 'max:100'],
      ]);
   }
}
