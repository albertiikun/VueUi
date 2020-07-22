<?php

namespace Functional\groups\commands\createGroup;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class CreateGroupValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'name' => 'required|string|unique:groups,name',
         'subject_Id' => 'required|uuid',
         'level' => 'required|numeric',
         'maxLevel' => 'required|numeric',
         'studentLimit' => 'required|numeric',
      ]);
   }
}
