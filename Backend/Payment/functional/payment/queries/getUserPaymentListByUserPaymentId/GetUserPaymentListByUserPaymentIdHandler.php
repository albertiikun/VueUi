<?php

namespace Functional\payment\queries\getUserPaymentListByUserPaymentId;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\UserPaymentList;

class GetUserPaymentListByUserPaymentIdHandler implements IMeteorHandler
{
    private $_userPaymetListModel;

    public function __construct()
    {
        $this->_userPaymetListModel = new UserPaymentList();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        return $this->_userPaymetListModel->where('userPayment_id', $request->id)->orderBy('from')->get();
    }
}
