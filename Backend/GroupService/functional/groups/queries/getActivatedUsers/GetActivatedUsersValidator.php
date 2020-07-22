<?php

namespace Functional\groups\queries\getActivatedUsers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetActivatedUsersValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'group_id' => 'required|uuid'
      ]);
   }
}
