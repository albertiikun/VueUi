<?php

namespace Functional\payment\commands\deletePayment;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Payment;

class DeletePaymentHandler implements IMeteorHandler
{
    private $_paymentModel;


    public function __construct()
    {
        $this->_paymentModel = new Payment();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        $this->_paymentModel->find($request->id)->delete();

        return response('Payment is deleted successfully', 200);
    }
}
