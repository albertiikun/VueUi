<?php

namespace Functional\groups\queries\getActivatedGroups;

use Carbon\Carbon;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\GroupStatus;

class GetActivatedGroupsHandler implements IMeteorHandler
{

    private $_groupStatusModel;

    public function __construct()
    {
        $this->_groupStatusModel = new GroupStatus();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        $timeNow = Carbon::now()->addHours(1)->toDateTimeString();

        return $this->_groupStatusModel->where("from", '<=', $timeNow)->where('to', '>=', $timeNow)
            ->pluck("group_id");
    }
}
