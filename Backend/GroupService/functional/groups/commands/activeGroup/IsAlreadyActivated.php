<?php

namespace Functional\groups\commands\activeGroup;

use Core\myvendor\common\Exceptions\GroupIsAlreadyActivatedInThisTime;
use Illuminate\Http\Request;

trait IsAlreadyActivated
{
    public function IsAlreadyActivatedGroup($model, Request $request, $from, $to)
    {
        $exists =  $model->where("from", '<=', $to)->where('to', '>=', $from)->where('group_id', $request->group_id)->count();
        if ($exists != 0) {
            throw new GroupIsAlreadyActivatedInThisTime();
        } else {
            return;
        }
    }
}
