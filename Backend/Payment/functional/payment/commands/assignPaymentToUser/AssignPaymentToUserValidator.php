<?php

namespace Functional\payment\commands\assignPaymentToUser;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class AssignPaymentToUserValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'user_id' => 'required|uuid',
         'group_id' => 'required|uuid',
         'payment_id' => 'required|uuid|exists:payments,id',
         'start_date' => 'required'
      ]);
   }
}
