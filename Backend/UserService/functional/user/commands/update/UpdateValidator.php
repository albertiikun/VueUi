<?php

namespace Functional\user\commands\update;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class UpdateValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {

        return $this->validate($request, [
            'name' => ['required', 'string', 'min:2', 'max:50'],
            'lastName' => ['required', 'string', 'min:2', 'max:50'],
            'phoneNumber' => ['required'],
            'birthDate' => ['required'],
            'city_id' => ['required', 'string', 'uuid'],
            'id' => ['required', 'uuid', 'exists:users,id'],
        ]);
    }
}
