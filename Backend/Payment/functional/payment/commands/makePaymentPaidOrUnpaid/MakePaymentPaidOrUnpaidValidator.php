<?php

namespace Functional\payment\commands\makePaymentPaidOrUnpaid;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class MakePaymentPaidOrUnpaidValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'id' => 'required|uuid|exists:user_payment_lists,id',
         'status' => 'required|numeric|min:0|max:1|digits:1'
      ]);
   }
}
