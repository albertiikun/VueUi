<?php

namespace Functional\payment\queries\getUsersForPayments;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\User;
use Domain\entities\UserPayment;

class GetUsersForPaymentsHandler implements IMeteorHandler
{


    public function __construct()
    {
        $this->_userModel = new User();
        $this->_userPaymentModel = new UserPayment();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        return $this->_userPaymentModel
            ->leftJoin('usr_service.users as user', function ($join) {
                $join->on('user_payments.user_id', '=', 'user.id');
            })
            ->select(['payments' => 'user_payments.*', 'user' => 'user.*'])
            ->get();
    }
}
