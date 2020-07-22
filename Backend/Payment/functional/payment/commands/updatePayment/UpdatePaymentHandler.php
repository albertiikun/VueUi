<?php

namespace Functional\payment\commands\updatePayment;

use Core\myvendor\functions\mapper\Mapper;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Payment;

class UpdatePaymentHandler implements IMeteorHandler
{
    private $_paymentModel;
    private $_mapper;

    public function __construct()
    {
        $this->_paymentModel = new Payment();
        $this->_mapper = new Mapper();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        $this->_mapper->updateMap($this->_paymentModel, $request->all());
        return response('Payment is updated successfully', 200);
    }
}
