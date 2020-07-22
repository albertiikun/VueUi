<?php

namespace Functional\payment\queries\getPaymentSchedule;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\PaymentSchedule;

class GetPaymentScheduleHandler implements IMeteorHandler
{
    private $_paymentScheduleModel;

    public function __construct()
    {
        $this->_paymentScheduleModel = new PaymentSchedule();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        return $this->_paymentScheduleModel->select("id", 'name')->latest('created_at')->get();
    }
}
