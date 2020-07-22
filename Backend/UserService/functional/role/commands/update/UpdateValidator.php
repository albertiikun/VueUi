<?php
namespace Functional\role\commands\update;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class UpdateValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {
        return $this->validate($request, [
            'name' => ['required', 'unique:roles,name'],
            'role_id' => ['required', 'uuid'],
        ]);
    }
}
