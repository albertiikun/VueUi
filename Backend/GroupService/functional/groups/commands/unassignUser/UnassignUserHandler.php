<?php

namespace Functional\groups\commands\unassignUser;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\GroupHasUser;

class UnassignUserHandler implements IMeteorHandler
{

    private $_groupHasUserModel;

    public function __construct()
    {
        $this->_groupHasUserModel = new GroupHasUser();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        $this->_groupHasUserModel->where("group_id", $request->group_id)->whereIn('user_id', $request->user_id)->delete();

        return response("Successfully unassigned!");
    }
}
