<?php

namespace Functional\role\queries\get;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Role;
use Illuminate\Http\Request;

class GetHandler implements IMeteorHandler
{

    private $_roleModel;

    public function __construct()
    {
        $this->_roleModel = new Role();
    }
    public function Handler(Request $request)
    {
        return  response($this->_roleModel->all(), 200);
    }
}
