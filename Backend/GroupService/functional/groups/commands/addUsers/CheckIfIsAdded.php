<?php

namespace Functional\groups\commands\addUsers;

use Core\myvendor\common\Exceptions\UserIsAlreadyAddedException;
use Illuminate\Http\Request;

trait CheckIfIsAdded
{
    public function Check(Request $request, $model)
    {
        $exist =  $model->whereIn('user_id', $request->user_id)->where('group_id', $request->group_id)->first();

        if ($exist) {
            throw new UserIsAlreadyAddedException();
        } else {
            return;
        }
    }
}
