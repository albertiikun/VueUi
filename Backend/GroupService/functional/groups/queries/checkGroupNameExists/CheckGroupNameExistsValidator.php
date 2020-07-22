<?php

namespace Functional\groups\queries\checkGroupNameExists;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class CheckGroupNameExistsValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'name' => 'required|unique:groups,name',
      ]);
   }
}
