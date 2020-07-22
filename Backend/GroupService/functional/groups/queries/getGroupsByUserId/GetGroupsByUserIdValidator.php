<?php

namespace Functional\groups\queries\getGroupsByUserId;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetGroupsByUserIdValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'userId' => 'required|uuid'
      ]);
   }
}
