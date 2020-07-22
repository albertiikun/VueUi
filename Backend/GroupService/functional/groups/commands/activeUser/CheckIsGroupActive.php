<?php

namespace Functional\groups\commands\activeUser;

use Carbon\Carbon;
use Core\myvendor\common\Exceptions\GroupIsNotActiveException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

trait CheckIsGroupActive
{
    public function IsGroupActive($model, Request $request)
    {
        $timeNow = Carbon::now()->addHours(1)->toDateTimeString();

        $exists =  $model->where("from", '<=', $timeNow)->where('to', '>=', $timeNow)
            ->where("group_id", $request->group_id)->first();

        if ($exists) {
            return $exists->id;
        } else {
            throw new GroupIsNotActiveException();
        }
    }
}
