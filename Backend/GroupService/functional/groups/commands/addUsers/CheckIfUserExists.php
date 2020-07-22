<?php

namespace Functional\groups\commands\addUsers;

use Core\myvendor\common\Exceptions\UserDoNotExistException;
use Illuminate\Http\Request;

trait CheckIfUserExists
{
    public function CheckUser(Request $request, $model)
    {
        $exist =  $model->whereIn('id', $request->user_id)->first();
        if ($exist) {
            return;
        } else {
            throw new UserDoNotExistException();
        }
    }
}
