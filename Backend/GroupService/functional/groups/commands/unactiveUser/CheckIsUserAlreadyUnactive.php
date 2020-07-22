<?php

namespace Functional\groups\commands\unactiveUser;

use Carbon\Carbon;
use Core\myvendor\common\Exceptions\GroupIsNotActiveException;
use Core\myvendor\common\Exceptions\UserIsAlreadyUnactiveException;
use Illuminate\Http\Request;

trait CheckIsUserAlreadyUnactive
{
    public function IsUserAlreadyUnactive($groupStatusModel, $userStatusModel, Request $request)
    {
        $timeNow = Carbon::now()->addHours(1)->toDateTimeString();

        $groupStatusId =  $groupStatusModel->where("from", '<=', $timeNow)->where('to', '>=', $timeNow)
            ->where("group_id", $request->group_id)
            ->pluck("id");

        if (!$groupStatusId) throw new GroupIsNotActiveException();

        $exists = $userStatusModel->whereIn("user_id", $request->user_id)->where("groupStatus_id", $groupStatusId);

        if ($exists->count() == 0) {
            throw new UserIsAlreadyUnactiveException();
        } else {
            $exists->delete();
            return;
        }
    }
}
