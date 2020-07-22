<?php

namespace Functional\countries\queries\getByCityId;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetCountryByCityIdValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'id' => 'required|string|exists:cities,id',
      ]);
   }
}
