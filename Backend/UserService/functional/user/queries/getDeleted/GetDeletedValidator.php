<?php

namespace Functional\user\queries\getDeleted;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetDeletedValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'page' => 'nullable',
         'itemsPerPage' => 'required',
         'search' => 'nullable'
      ]);
   }
}
