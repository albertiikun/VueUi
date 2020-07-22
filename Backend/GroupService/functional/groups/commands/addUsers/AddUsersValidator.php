<?php

namespace Functional\groups\commands\addUsers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class AddUsersValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         "user_id"    => "required|array",
         "user_id.*"  => "required|uuid|distinct",
         'group_id' => 'required|uuid|exists:groups,id,deleted_at,NULL'
      ]);
   }
}
