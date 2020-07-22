<?php

namespace Functional\user\commands\update;

use Core\myvendor\common\Responses\UserResponse;
use Core\myvendor\functions\mapper\Mapper;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\User;
use Illuminate\Http\Request;

class UpdateHandler implements IMeteorHandler
{
    use CanUpdate;

    private $_mapper;
    private $_userModel;

    public function __construct()
    {
        $this->_mapper = new Mapper();
        $this->_userModel = new User();
    }


    public function Handler(Request $request)
    {
        $this->CanUpdateUserData($request->id);

        $this->_mapper->updateMap($this->_userModel, $request->all(), 'password');

        return UserResponse::SuccessUpdate();
    }
}
