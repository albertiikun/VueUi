<?php

namespace Functional\groups\commands\updateGroup;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class UpdateGroupValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'id' => 'required|uuid|exists:groups,id,deleted_at,NULL',
         'name' => 'required|string|unique:groups,name,' . $request->id,
         'subject_Id' => 'required|uuid',
         'maxLevel' => 'required|numeric',
         'studentLimit' => 'required|numeric',
      ]);
   }
}
