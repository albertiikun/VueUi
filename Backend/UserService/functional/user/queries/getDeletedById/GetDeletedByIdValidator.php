<?php
namespace Functional\user\queries\getDeletedById;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetDeletedByIdValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {
        return $this->validate($request, [
            'id' => ['required', 'uuid', 'exists:users,id,deleted_at,NOT_NULL'],
        ]);
    }
}
