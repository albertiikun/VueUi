<?php

namespace Functional\payment\queries\getPaymentById;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Payment;

class GetPaymentByIdHandler implements IMeteorHandler
{
    private $_paymentModel;

    public function __construct()
    {
        $this->_paymentModel = new Payment();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        return $this->_paymentModel->find($request->id);
    }
}
