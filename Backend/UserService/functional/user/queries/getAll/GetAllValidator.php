<?php

namespace Functional\user\queries\getAll;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetAllValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'page' => 'nullable',
         'itemsPerPage' => ['required', 'numeric'],
         'search' => 'nullable'
      ]);
   }
}
