<?php

namespace Functional\role\commands\unAssignPermission;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class UnAssignPermissionValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'role_id' => 'required|uuid|exists:roles,id',
         'permission_id' => 'required|uuid|exists:permissions,id'
      ]);
   }
}
