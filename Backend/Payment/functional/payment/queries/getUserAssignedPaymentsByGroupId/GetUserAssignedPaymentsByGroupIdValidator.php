<?php

namespace Functional\payment\queries\getUserAssignedPaymentsByGroupId;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetUserAssignedPaymentsByGroupIdValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'user_id' => 'required|uuid',
         'group_id' => 'required|uuid',
      ]);
   }
}
