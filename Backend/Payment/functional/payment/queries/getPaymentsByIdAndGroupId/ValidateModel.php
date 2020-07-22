<?php

namespace Functional\payment\queries\getPaymentsByIdAndGroupId;

use Core\myvendor\common\Exceptions\GroupNotExistsException;
use Core\myvendor\common\Exceptions\UserNotFoundException;
use Illuminate\Http\Request;

trait ValidateModel
{
    private function checkUserExsists($userModel, Request $request)
    {
        $exists = $userModel->where('id', $request->user_id)->first();

        if (!$exists) throw new UserNotFoundException();
    }

    private function checkGroupExists($groupModel, Request $request)
    {

        $exists = $groupModel->where('id', $request->group_id)->first();

        if (!$exists) throw new GroupNotExistsException();
    }
}
