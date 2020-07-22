<?php

namespace Functional\payment\commands\deletePayment;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class DeletePaymentValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'id' => ['required', 'uuid', 'exists:payments,id']
      ]);
   }
}
