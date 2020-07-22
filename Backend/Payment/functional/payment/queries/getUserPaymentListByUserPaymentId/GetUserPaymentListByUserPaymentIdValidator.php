<?php

namespace Functional\payment\queries\getUserPaymentListByUserPaymentId;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetUserPaymentListByUserPaymentIdValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'id' => 'required|uuid|exists:user_payments,id',
      ]);
   }
}
