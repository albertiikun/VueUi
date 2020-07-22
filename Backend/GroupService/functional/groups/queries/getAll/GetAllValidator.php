<?php

namespace Functional\groups\queries\getAll;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetAllValidator
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
