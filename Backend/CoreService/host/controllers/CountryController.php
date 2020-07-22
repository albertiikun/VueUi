<?php

namespace Host\controllers;

use Functional\countries\queries\getByCityId\GetCountryByCityIdHandler;
use Functional\countries\queries\getById\GetCountryByIdHandler;
use Host\controllers\base\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function GetCountryById(GetCountryByIdHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function GetCountryByCityId(GetCountryByCityIdHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }
}
