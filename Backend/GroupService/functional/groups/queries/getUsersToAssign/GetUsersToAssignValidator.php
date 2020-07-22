<?php

namespace Functional\groups\queries\getUsersToAssign;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetUsersToAssignValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'group_id' => 'required|uuid|exists:groups,id',
         'search' => 'required|string'
      ]);
   }
}
