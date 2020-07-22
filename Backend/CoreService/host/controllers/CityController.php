<?php

namespace Host\controllers;

use Functional\cities\queries\get\GetAllHandler;
use Host\controllers\base\Controller;

class CityController extends Controller
{
    public function Get(GetAllHandler $query)
    {
        return $this->_meteor->Send($query);
    }

}
