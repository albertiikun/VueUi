<?php

namespace Functional\groups\commands\activeGroup;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class ActiveGroupValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'group_id' => 'required|uuid|exists:groups,id,deleted_at,NULL',
         'from' => 'required|date_format:H:i',
         'to' => 'required|date_format:H:i'
      ]);
   }
}
