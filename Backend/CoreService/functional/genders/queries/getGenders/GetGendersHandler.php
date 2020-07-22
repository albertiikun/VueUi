<?php

namespace Functional\genders\queries\getGenders;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Gender;

class GetGendersHandler implements IMeteorHandler
{
    public function Handler(\Illuminate\Http\Request $request)
    {
        return response(Gender::all(), 200);
    }
}
