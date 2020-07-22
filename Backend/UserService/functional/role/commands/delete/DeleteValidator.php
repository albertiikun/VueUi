<?php

namespace Functional\role\commands\delete;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class DeleteValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {
        return  $this->validate($request, [
            'role_id' => ['uuid', 'required', 'exists:roles,id'],
        ]);
    }
}
