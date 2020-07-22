<?php

namespace Functional\payment\queries\getPaymentsByIdAndGroupId;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Group;
use Domain\entities\Payment;
use Domain\entities\User;
use Domain\entities\UserPayment;

class GetPaymentsByIdAndGroupIdHandler implements IMeteorHandler
{
    use ValidateModel;

    private $_paymentModel;
    private $_userModel;
    private $_groupModel;
    private $_userPaymentModel;

    public function __construct()
    {
        $this->_userPaymentModel = new UserPayment();
        $this->_paymentModel = new Payment();
        $this->_userModel = new User();
        $this->_groupModel = new Group();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        $this->checkUserExsists($this->_userModel, $request);
        $this->checkGroupExists($this->_groupModel, $request);

        $userPayment = $this->_userPaymentModel->where('user_id', $request->user_id)->where('group_id', $request->group_id)->pluck('payment_id');


        return $this->_paymentModel
            ->leftJoin('payment_schedules as schedule', 'payments.paymentSchedule_id', '=', 'schedule.id')
            ->whereNotIn('payments.id', $userPayment)
            ->where('payments.group_id', $request->group_id)
            ->select('payments.*', 'schedule.name as schedule')
            ->get();
    }
}
