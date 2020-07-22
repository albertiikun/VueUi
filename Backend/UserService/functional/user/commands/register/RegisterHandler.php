<?php

namespace Functional\user\commands\register;

use Core\myvendor\common\Responses\UserResponse;
use Core\myvendor\functions\auth\ThisAuth;
use Core\myvendor\functions\mapper\Mapper;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\User;
use Illuminate\Http\Request;

class RegisterHandler implements IMeteorHandler
{
    private $_mapper;

    public function __construct()
    {
        $this->_mapper = new Mapper();
    }

    public function Handler(Request $request)
    {
        ThisAuth::CanCreateRole($request->role_id);

        $this->_mapper->createMap(new User(), $request->all(), 'password', 'role_id');

        $this->_mapper->setRole($request->role_id);

        return UserResponse::SuccessCreate();
    }
}
