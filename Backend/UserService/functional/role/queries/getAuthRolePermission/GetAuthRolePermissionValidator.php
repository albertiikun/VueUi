<?php

namespace Functional\role\queries\getAuthRolePermission;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetAuthRolePermissionValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, []);
   }
}
