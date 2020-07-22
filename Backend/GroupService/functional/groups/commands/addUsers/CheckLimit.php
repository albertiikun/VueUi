<?php

namespace Functional\groups\commands\addUsers;

use Core\myvendor\common\Exceptions\StudentLimitException;
use Illuminate\Http\Request;

trait CheckLimit
{
    public function CheckLimit(Request $request, $modelGroupHasStudent, $modelGroup)
    {
        $exist =  $modelGroupHasStudent->where('group_id', $request->group_id)->count();
        $studentLimit = $modelGroup->where('id', $request->group_id)->first();
        if ($exist + count($request->user_id) > $studentLimit->studentLimit) {
            throw new StudentLimitException();
        } else {
            return;
        }
    }
}
