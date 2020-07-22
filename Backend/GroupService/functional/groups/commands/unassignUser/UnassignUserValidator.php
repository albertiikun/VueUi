<?php

namespace Functional\groups\commands\unassignUser;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class UnassignUserValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         "user_id"    => "required|array",
         "user_id.*"  => "required|uuid|distinct|exists:group_has_users,user_id,group_id,{$request->group_id}",
         'group_id' => 'required|uuid|exists:groups,id,deleted_at,NULL'
      ]);
   }
}
