<?php

namespace Functional\events\commands\createEvent;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class CreateEventValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'name' => 'required|string',
         'description' => 'nullable|string',
         'from' => 'required|date',
         'to' => 'required|date',
         'color' => 'required|string'
      ]);
   }
}
