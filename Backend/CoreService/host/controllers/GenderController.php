<?php

namespace Host\controllers;

use Functional\genders\queries\getGenders\GetGendersHandler;
use Host\controllers\base\Controller;

class GenderController extends Controller
{
    public function Get(GetGendersHandler $query)
    {
        return $this->_meteor->Send($query);
    }
}
