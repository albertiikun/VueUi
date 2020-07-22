<?php

namespace Functional\payment\commands\createPayment;

use Core\myvendor\common\Exceptions\GroupNotExistsException;
use Core\myvendor\functions\mapper\Mapper;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Group;
use Domain\entities\Payment;

class CreatePaymentHandler implements IMeteorHandler
{
    private $_mapper;
    private $_paymentModel;
    private $_groupModel;

    public function __construct()
    {
        $this->_groupModel = new Group();
        $this->_mapper = new Mapper();
        $this->_paymentModel = new Payment();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        if ($request->group_id != null) {
            $group = $this->_groupModel->find($request->group_id)->first();

            if (!$group) throw new GroupNotExistsException();
        }

        $this->_mapper->createMap($this->_paymentModel, $request->all());

        return response('Payment is registred successfully!');
    }
}
