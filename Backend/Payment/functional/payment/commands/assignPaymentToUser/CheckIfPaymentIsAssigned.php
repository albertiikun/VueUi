<?php

namespace Functional\payment\commands\assignPaymentToUser;

use Core\myvendor\common\Exceptions\UserPaymentIsAlreadyAssignedException;
use Illuminate\Http\Request;

trait CheckIfPaymentIsAssigned
{
    private function IsAlreadyAssigned($userPaymentModel, Request $request)
    {
        $exists =  $userPaymentModel->where('user_id', $request->user_id)
            ->where('group_id', $request->group_id)
            ->where('payment_id', $request->payment_id)
            ->first();

        if ($exists) throw new UserPaymentIsAlreadyAssignedException();
    }
}
