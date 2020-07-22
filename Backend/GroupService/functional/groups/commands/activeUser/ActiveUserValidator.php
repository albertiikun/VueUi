<?php

namespace Functional\groups\commands\activeUser;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class ActiveUserValidator
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
