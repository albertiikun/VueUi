<?php

namespace Functional\payment\queries\getPaymentsByIdAndGroupId;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetPaymentsByIdAndGroupIdValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'user_id' => 'uuid|required',
         'group_id' => 'uuid|required'
      ]);
   }
}
