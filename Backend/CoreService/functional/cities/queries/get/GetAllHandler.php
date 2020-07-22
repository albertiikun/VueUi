<?php

namespace Functional\cities\queries\get;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\City;

class GetAllHandler implements IMeteorHandler
{
    private $_cityModel;

    public function __construct()
    {
        $this->_cityModel = new City();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        return $this->_cityModel->all();
    }
}
