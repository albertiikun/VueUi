<?php

namespace Functional\groups\commands\updateGroupLevel;

use Core\myvendor\common\Exceptions\updateGroup\MaxLevelReachedExcetion;
use Illuminate\Http\Request;

trait CheckIfLevelIsValid
{
    private function IsLevelValid($groupModel, Request $request)
    {
        $group = $groupModel->find($request->id);

        if ($request->level > $group->maxLevel) throw new MaxLevelReachedExcetion();

        return;
    }
}
