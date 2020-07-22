<?php

namespace Functional\countries\queries\getById;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetCountryByIdValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'id' => 'required|string|exists:countries,id',
      ]);
   }
}
