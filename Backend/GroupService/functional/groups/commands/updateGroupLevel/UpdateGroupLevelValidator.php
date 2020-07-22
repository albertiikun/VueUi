<?php

namespace Functional\groups\commands\updateGroupLevel;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class UpdateGroupLevelValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'id' => 'required|uuid|exists:groups,id,deleted_at,NULL',
         'level' => 'required|numeric|min:0'
      ]);
   }
}
