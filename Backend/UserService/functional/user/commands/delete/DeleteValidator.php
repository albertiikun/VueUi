<?php
namespace Functional\user\commands\delete;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class DeleteValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {
        return $this->validate($request, [
            'id' => ['uuid', 'required', 'exists:users,id,deleted_at,NULL'],
        ]);
    }
}
