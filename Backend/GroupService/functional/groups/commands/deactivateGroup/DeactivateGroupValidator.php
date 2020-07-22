<?php

namespace Functional\groups\commands\deactivateGroup;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class DeactivateGroupValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'group_id' => 'required|uuid',
      ]);
   }
}
