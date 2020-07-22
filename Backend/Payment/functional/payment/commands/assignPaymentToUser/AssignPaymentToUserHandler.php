<?php

namespace Functional\payment\commands\assignPaymentToUser;

use Carbon\Carbon;
use Core\myvendor\functions\mapper\Mapper;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Group;
use Domain\entities\Payment;
use Domain\entities\User;
use Domain\entities\UserPayment;
use Functional\payment\scheduler\AssignPaymentScheduler;
use Illuminate\Http\Request;

class AssignPaymentToUserHandler implements IMeteorHandler
{
    use ValidateModel, CheckIfPaymentIsAssigned;

    private $_userPaymentModel;
    private $_userModel;
    private $_groupModel;
    private $_mapper;
    private $_paymentModel;


    public function __construct()
    {
        $this->_userPaymentModel = new UserPayment();
        $this->_userModel = new User();
        $this->_groupModel = new Group();
        $this->_mapper = new Mapper();
        $this->_paymentModel = new Payment();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {

        $this->checkUserExsists($this->_userModel, $request);
        $this->checkGroupExists($this->_groupModel, $request);
        $this->IsAlreadyAssigned($this->_userPaymentModel, $request);
        $date = $this->CheckAndParseDate($request);

        $this->_mapper->createMap(
            $this->_userPaymentModel,
            array('user_id' => $request->user_id, 'group_id' => $request->group_id, 'start_date' => $date, 'payment_id' => $request->payment_id)
        );

        return response('Payment is assigned successfuly', 200);
    }

    private function CheckAndParseDate(Request $request)
    {
        $paymentScheduleName = $this->_paymentModel->where('payments.id', $request->payment_id)
            ->leftJoin('payment_schedules as schedule', 'payments.paymentSchedule_id', '=', 'schedule.id')
            ->pluck('schedule.name');

        if (strtolower($paymentScheduleName[0]) == strtolower('One Time')) {
            return null;
        } else {
            return Carbon::parse($request->start_date);
        }
    }
}
