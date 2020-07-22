<?php

namespace Functional\groups\queries\getActivatedUsers;

use Carbon\Carbon;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\GroupStatus;
use Domain\entities\UserStatus;

class GetActivatedUsersHandler implements IMeteorHandler
{

    private $_userStatusModel;
    private $_groupStatusModel;

    public function __construct()
    {
        $this->_userStatusModel = new UserStatus();
        $this->_groupStatusModel = new GroupStatus();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        $timeNow = Carbon::now()->addHours(1)->toDateTimeString();

        $groupStatusId =  $this->_groupStatusModel->where("from", '<=', $timeNow)->where('to', '>=', $timeNow)
            ->where("group_id", $request->group_id)
            ->pluck("id");

        return  $this->_userStatusModel->where("groupStatus_id", $groupStatusId)->pluck('user_id');
    }
}
