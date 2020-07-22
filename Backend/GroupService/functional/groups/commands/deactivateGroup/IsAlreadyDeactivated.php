<?php

namespace Functional\groups\commands\deactivateGroup;

use Carbon\Carbon;
use Core\myvendor\common\Exceptions\GroupIsNotActiveException;
use Illuminate\Http\Request;

trait IsAlreadyDeactivated
{
    public function IsAlreadyDeactivatedGroup($groupStatusModel, $userStatusModel, Request $request)
    {
        $timeNow = Carbon::now()->addHours(1)->toDateTimeString();

        $group =  $groupStatusModel->where("from", '<=', $timeNow)->where('to', '>=', $timeNow)
            ->where("group_id", $request->group_id);

        $groupStatusId =  $group->pluck("id");

        if (!$groupStatusId) throw new GroupIsNotActiveException();

        return $group;
    }
}
