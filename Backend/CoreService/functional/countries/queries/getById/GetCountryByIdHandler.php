<?php

namespace Functional\countries\queries\getById;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Country;

class GetCountryByIdHandler implements IMeteorHandler
{

    public function Handler(\Illuminate\Http\Request $request)
    {
        return Country::where('id', $request->id)->get();
    }
}
