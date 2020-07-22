<?php

namespace Functional\user\queries\getById;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetByIdValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {
        return $this->validate($request, [
            'id' => ['required', 'uuid', 'exists:users,id,deleted_at,NULL'],
        ]);
    }
}
