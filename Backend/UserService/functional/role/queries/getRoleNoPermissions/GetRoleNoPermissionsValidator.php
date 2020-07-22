<?php

namespace Functional\role\queries\getRoleNoPermissions;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetRoleNoPermissionsValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'id' => 'uuid|required',
      ]);
   }
}
