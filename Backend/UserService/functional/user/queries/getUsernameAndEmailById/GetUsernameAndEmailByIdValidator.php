<?php

namespace Functional\user\queries\getUsernameAndEmailById;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetUsernameAndEmailByIdValidator
{
   use ProvidesConvenienceMethods;

   public function Validations(Request $request)
   {
      return $this->validate($request, [
         'id' => ['required', 'uuid', 'exists:users,id,deleted_at,NULL'],
      ]);
   }
}
