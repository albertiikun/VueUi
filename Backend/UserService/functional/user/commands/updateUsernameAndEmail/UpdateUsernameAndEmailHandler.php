<?php

namespace Functional\user\commands\updateUsernameAndEmail;

use Core\myvendor\common\Responses\UserResponse;
use Core\myvendor\functions\mapper\Mapper;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\User;

class UpdateUsernameAndEmailHandler implements IMeteorHandler
{
    use CanUpdateUsernameAndEmail;

    private $_mapper;
    private $_userModel;

    public function __construct()
    {
        $this->_mapper = new Mapper();
        $this->_userModel = new User();
    }
    public function Handler(\Illuminate\Http\Request $request)
    {
        $this->CanUpdateUsernameAndEmail($request->id);


        $this->_mapper->updateMap($this->_userModel, $request->all());

        return UserResponse::SuccessUpdate();
    }
}
