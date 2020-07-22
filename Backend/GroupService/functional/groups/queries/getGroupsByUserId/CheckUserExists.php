<?php

namespace Functional\groups\queries\getGroupsByUserId;

use Core\myvendor\common\Exceptions\UserDoNotExistException;

trait CheckUserExists
{
    private function ExistsUser($userModel, $userId)
    {
        $exists = $userModel->where('id', $userId)->first();

        if (!$exists) throw new UserDoNotExistException();

    }
}
