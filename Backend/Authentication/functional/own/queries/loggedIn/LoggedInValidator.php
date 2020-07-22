<?php
namespace Functional\own\queries\loggedIn;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class LoggedInValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {
        return $this->validate($request, [
            ## example 'password' => 'required|string',
        ]);
    }
}
