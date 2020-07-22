<?php

namespace Functional\countries\queries\getByCityId;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\City;
use Domain\entities\Country;

class GetCountryByCityIdHandler implements IMeteorHandler
{

    public function Handler(\Illuminate\Http\Request $request)
    {
        return City::where('cities.id', $request->id)->leftJoin('countries', 'cities.country_id', '=', 'countries.id')->get();
    }
}
