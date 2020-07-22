<?php

namespace Functional\payment\queries\getPayments;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetPaymentsValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'page' => 'nullable',
         'itemsPerPage' => ['required', 'numeric'],
         'search' => 'nullable'
      ]);
   }
}
