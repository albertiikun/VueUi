<?php

namespace Functional\payment\queries\getUserAssignedPaymentsByGroupId;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\UserPayment;
use Illuminate\Support\Facades\DB;

class GetUserAssignedPaymentsByGroupIdHandler implements IMeteorHandler
{
    private $_userPaymentModel;

    public function __construct()
    {
        $this->_userPaymentModel = new UserPayment();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        return $this->_userPaymentModel
            ->where('user_payments.user_id', $request->user_id)
            ->where('user_payments.group_id', $request->group_id)
            ->leftJoin('payments', 'payments.id', '=', 'user_payments.payment_id')
            ->leftJoin('payment_schedules as schedule', 'payments.paymentSchedule_id', '=', 'schedule.id')
            ->select(
                'user_payments.*',
                'payments.name',
                'payments.price',
                'schedule.name as schedule',
                DB::raw('(SELECT COUNT(*) FROM user_payment_lists WHERE user_payment_lists.userPayment_id = user_payments.id AND user_payment_lists.active = false) as paymentsTodo')
            )->get();
    }
}
