<?php

namespace Functional\payment\queries\getPaymentById;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetPaymentByIdValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'id' => ['required', 'uuid', 'exists:payments,id']
      ]);
   }
}
