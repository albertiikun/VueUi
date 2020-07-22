<?php

namespace Functional\role\commands\register;

use Core\myvendor\functions\auth\ThisAuth;
use Core\myvendor\functions\mapper\Mapper;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Role;
use Illuminate\Http\Request;

class RegisterHandler implements IMeteorHandler
{
    private $_mapper;
    private $_roleModel;

    public function __construct()
    {
        $this->_mapper = new Mapper();
        $this->_roleModel = new Role();
    }

    public function Handler(Request $request)
    {
        ThisAuth::HasPermissionsOrDie('manage-roles');

        $this->_mapper->createMap($this->_roleModel, $request->all());


        dispatch(new RegisterRolePermissionsJob($request->name));

        return response('Role is created successfully', 200);
    }
}
