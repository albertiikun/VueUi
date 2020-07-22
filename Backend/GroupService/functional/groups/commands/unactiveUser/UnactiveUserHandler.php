<?php

namespace Functional\groups\commands\unactiveUser;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\GroupStatus;
use Domain\entities\UserStatus;

class UnactiveUserHandler implements IMeteorHandler
{
    use CheckIsUserAlreadyUnactive;


    private $_userStatusModel;
    private $_groupStatusModel;

    public function __construct()
    {
        $this->_userStatusModel = new UserStatus();
        $this->_groupStatusModel = new GroupStatus();
    }


    public function Handler(\Illuminate\Http\Request $request)
    {
        $this->IsUserAlreadyUnactive($this->_groupStatusModel, $this->_userStatusModel, $request);

        return response("Users are deactivated successfully", 200);
    }
}
