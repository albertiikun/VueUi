<?php

namespace Functional\user\queries\checkUsernameExist;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class CheckUsernameExistValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'userName' => ['required', 'unique:users,userName', 'string', 'max:100'],
      ]);
   }
}
