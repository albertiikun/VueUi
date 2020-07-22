<?php
namespace Functional\own\queries\requestConfirmEmail;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class RequestConfirmEmailValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {
        return $this->validate($request, [
            'email' => ['required'],
        ]);
    }
}
