<?php

namespace Functional\payment\queries\getUserPaymentsByGroupId;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Group;
use Domain\entities\GroupHasUser;
use Domain\entities\User;

class GetUserPaymentsByGroupIdHandler implements IMeteorHandler
{
    private $_userModel;
    private $_groupHasUser;

    public function __construct()
    {
        $this->_userModel = new User();
        $this->_groupHasUser = new GroupHasUser();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        $userIds = $this->_groupHasUser->where('group_id', $request->group_id)->pluck('user_id');
        return $this->_userModel->whereIn('id', $userIds)->get();
    }
}
