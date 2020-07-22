<?php

namespace Functional\user\commands\setUserIpRestriction;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class SetUserIpRestrictionValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {
        return $this->validate($request, [
            'id' => ['required', 'uuid', 'exists:users,id,deleted_at,NULL'],
            'ip.*' => ['required', 'ip'],
        ]);
    }
}
