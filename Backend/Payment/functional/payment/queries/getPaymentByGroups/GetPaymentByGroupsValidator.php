<?php

namespace Functional\payment\queries\getPaymentByGroups;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetPaymentByGroupsValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'page' => 'nullable',
         'search' => 'nullable',
      ]);
   }
}
