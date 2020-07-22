<?php

namespace Functional\user\queries\checkEmailExist;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class CheckEmailExistValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'email' => ['required', 'unique:users,email,', 'email', 'max:100'],
      ]);
   }
}
