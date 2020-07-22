<?php

namespace Functional\events\commands\deleteEvent;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class DeleteEventValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'id' => 'required|uuid|exists:events,id',
      ]);
   }
}
