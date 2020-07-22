<?php

namespace Functional\payment\queries\getUserPaymentsByGroupId;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetUserPaymentsByGroupIdValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'group_id' => 'required|uuid',
      ]);
   }
}
