<?php
namespace Functional\own\queries\checkAuth;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class CheckAuthValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {
        return $this->validate($request, [
            ## example 'password' => 'required|string',
        ]);
    }
}
