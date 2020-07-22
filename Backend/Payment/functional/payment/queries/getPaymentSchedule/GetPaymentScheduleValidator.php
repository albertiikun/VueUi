<?php

namespace Functional\payment\queries\getPaymentSchedule;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetPaymentScheduleValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, []);
   }
}
