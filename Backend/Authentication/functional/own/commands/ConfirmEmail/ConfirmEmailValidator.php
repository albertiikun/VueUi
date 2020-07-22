<?php
namespace Functional\own\commands\ConfirmEmail;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class ConfirmEmailValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {
      return  $this->validate($request, [
            'token' => ['required'],
        ]);
    }
}
