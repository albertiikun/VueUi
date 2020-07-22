<?php
namespace Functional\swagger\commands\register;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class SwaggerValidator
{
    use ProvidesConvenienceMethods;

    public function Validations(Request $request)
    {
        return $this->validate($request, [
            'fileName' => 'required|string',
            'uri' => 'required|string',
            'method' => 'required|string',
            'summary' => 'required|string',
            'tag' => 'required|string',
            'property.*' => 'required',
        ]);
    }
}
