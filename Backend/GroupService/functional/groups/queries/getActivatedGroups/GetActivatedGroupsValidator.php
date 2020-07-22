<?php

namespace Functional\groups\queries\getActivatedGroups;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetActivatedGroupsValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, []);
   }
}
