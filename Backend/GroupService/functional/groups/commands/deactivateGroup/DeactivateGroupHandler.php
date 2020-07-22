<?php

namespace Functional\groups\commands\deactivateGroup;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\GroupStatus;
use Domain\entities\UserStatus;

class DeactivateGroupHandler implements IMeteorHandler
{
    use IsAlreadyDeactivated;

    private $_userStatusModel;
    private $_groupStatusModel;

    public function __construct()
    {
        $this->_userStatusModel = new UserStatus();
        $this->_groupStatusModel = new GroupStatus();
    }


    public function Handler(\Illuminate\Http\Request $request)
    {
        $group = $this->IsAlreadyDeactivatedGroup($this->_groupStatusModel, $this->_userStatusModel, $request);

        $group->delete();

        return response("Group is deactivated successfully", 200);
    }
}
