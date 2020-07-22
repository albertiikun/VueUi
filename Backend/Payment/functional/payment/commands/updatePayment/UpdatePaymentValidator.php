<?php

namespace Functional\payment\commands\updatePayment;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class UpdatePaymentValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'id' => ['required', 'uuid', 'exists:payments,id'],
         'name' => 'required|string|unique:payments,name,' . $request->id,
         'price' => 'required|numeric',
         'group_id' => 'nullable|uuid',
         'paymentSchedule_id' => 'required|uuid|exists:payment_schedules,id'
      ]);
   }
}
