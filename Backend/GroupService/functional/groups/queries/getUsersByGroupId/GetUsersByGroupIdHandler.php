<?php

namespace Functional\groups\queries\getUsersByGroupId;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\GroupHasUser;
use Domain\entities\User;

class GetUsersByGroupIdHandler implements IMeteorHandler
{
    private $_GroupHasUserModel;
    private $_userModel;
    public function __construct()
    {
        $this->_GroupHasUserModel = new GroupHasUser();
        $this->_userModel = new User();
    }
    public function Handler(\Illuminate\Http\Request $request)
    {
        $groupHasUser = $this->_GroupHasUserModel->where("group_id", $request->id)->pluck('user_id');
        return $this->_userModel->whereIn('id', $groupHasUser)->select('id', 'email', 'name', 'lastName', 'username')->get();
    }
}
