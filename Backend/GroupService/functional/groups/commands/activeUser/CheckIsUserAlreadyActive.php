<?php

namespace Functional\groups\commands\activeUser;

use Carbon\Carbon;
use Core\myvendor\common\Exceptions\GroupIsNotActiveException;
use Core\myvendor\common\Exceptions\UserIsAlreadyActiveException;
use Illuminate\Http\Request;

trait CheckIsUserAlreadyActive
{
    public function IsUserAlreadyActive($groupStatusModel, $userStatusModel, Request $request)
    {
        $timeNow = Carbon::now()->addHours(1)->toDateTimeString();

        $groupStatusId =  $groupStatusModel->where("from", '<=', $timeNow)->where('to', '>=', $timeNow)
            ->where("group_id", $request->group_id)
            ->pluck("id");

        if (!$groupStatusId) throw new GroupIsNotActiveException();


        $exists = $userStatusModel->whereIn("user_id", $request->user_id)->where("groupStatus_id", $groupStatusId)->count();

        if ($exists != 0) {
            throw new UserIsAlreadyActiveException();
        } else {
            return;
        }
    }
}
