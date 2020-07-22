<?php

namespace Functional\groups\commands\updateGroup;

use Core\myvendor\common\Exceptions\updateGroup\MaxLevelException;
use Core\myvendor\common\Exceptions\updateGroup\StudentLimitException;
use Illuminate\Http\Request;

trait CheckGroupUpdates
{
    private function CheckGroup($groupModel, $groupHasUserModel, Request $request)
    {
        $group = $groupModel->find($request->id);

        $users = $groupHasUserModel->where("group_id", $request->id)->count();

        if ($request->maxLevel < $group->level) throw new MaxLevelException();

        if ($request->studentLimit < $users) throw new StudentLimitException();
    }
}
