<?php
namespace Functional\own\queries\forgotPassword;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class ForgotPasswordValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {
        return $this->validate($request, [
            'email' => 'required|string',
        ]);
    }
}
