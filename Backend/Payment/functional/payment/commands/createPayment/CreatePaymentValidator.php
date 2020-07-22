<?php

namespace Functional\payment\commands\createPayment;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class CreatePaymentValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'name' => 'required|string|unique:payments,name',
         'price' => 'required|numeric',
         'group_id' => 'nullable|uuid',
         'paymentSchedule_id' => 'required|uuid|exists:payment_schedules,id'
      ]);
   }
}
