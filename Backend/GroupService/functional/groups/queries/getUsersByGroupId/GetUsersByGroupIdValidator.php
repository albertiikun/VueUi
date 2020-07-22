<?php

namespace Functional\groups\queries\getUsersByGroupId;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetUsersByGroupIdValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'id' => 'required|uuid|exists:groups,id,deleted_at,NULL'
      ]);
   }
}
