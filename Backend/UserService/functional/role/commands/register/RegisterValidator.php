<?php

namespace Functional\role\commands\register;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class RegisterValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {
        return $this->validate($request, [
            'name' => 'required|unique:roles,name'
        ]);
    }
}
