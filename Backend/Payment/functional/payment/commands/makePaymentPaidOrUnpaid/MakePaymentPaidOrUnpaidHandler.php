<?php


namespace Functional\payment\commands\makePaymentPaidOrUnpaid;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\UserPaymentList;

class MakePaymentPaidOrUnpaidHandler implements IMeteorHandler
{
    private $_userPaymentListModel;

    public function __construct()
    {
        $this->_userPaymentListModel = new UserPaymentList();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        $paymentList = $this->_userPaymentListModel->find($request->id);
        $paymentList->active = $request->status;
        $paymentList->save();


        return response('Payment status is set successfully', 200);
    }
}
