<?php

namespace Functional\events\commands\editEvent;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class EditEventValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'id' => 'required|uuid|exists:events,id',
         'name' => 'required|string',
         'description' => 'nullable|string',
         'from' => 'required|date',
         'to' => 'required|date',
         'color' => 'required|string'
      ]);
   }
}
