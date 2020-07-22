<?php

namespace Functional\payment\scheduler;

use Carbon\Carbon;
use Domain\entities\UserPayment;
use Domain\entities\UserPaymentList;
use Illuminate\Console\Command;

class AssignPaymentScheduler extends Command
{
    protected $signature = 'assignPayment:scheduler';

    protected $description = 'added a new payment if it is time';

    private $_userPaymentModel;
    private $_userPaymentListModel;


    public function __construct()
    {
        parent::__construct();
        $this->_userPaymentModel = new UserPayment();
        $this->_userPaymentListModel = new UserPaymentList();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $userPayments = $this->_userPaymentModel
            ->leftJoin('payments', 'payments.id', '=', 'user_payments.payment_id')
            ->leftJoin('payment_schedules as schedule', 'payments.paymentSchedule_id', '=', 'schedule.id')
            ->whereNotNull('user_payments.start_date')
            ->select('user_payments.*', 'schedule.name as schedule')
            ->get();

        foreach ($userPayments as $key => $userPayment) {
            $userPaymentList = $this->_userPaymentListModel->where('userPayment_id', $userPayment->id)->count();
            $this->shouldCreatePaymentList($userPaymentList, $userPayment);
        }
    }

    private function shouldCreatePaymentList($userPaymentList, $userPayment)
    {
        if ($userPaymentList == 0) {
            $oldDate = $userPayment->start_date;
            $newDate = $this->newDate($userPayment->schedule, $userPayment->start_date);
            $this->CreatePaymentList($userPayment, $newDate, $oldDate);
        }
        $do = true;

        $userPaymentList = $this->_userPaymentListModel
            ->where('userPayment_id', $userPayment->id)
            ->orderBy('to', 'desc')
            ->first();

        while ($do) {
            $oldDate = $userPaymentList->to;
            $newDate = $this->newDate($userPayment->schedule, $oldDate);
            if (Carbon::parse($userPaymentList->to)->lessThan(Carbon::now())) {
                $userPaymentList = $this->CreatePaymentList($userPayment, $newDate, $oldDate);
            } else {
                $do = false;
            }
        }
    }

    private function CreatePaymentList($userPayment, $newDate, $oldDate)
    {
        $newPaymentList = new $this->_userPaymentListModel;
        $newPaymentList->userPayment_id = $userPayment->id;
        $newPaymentList->from = $oldDate;
        $newPaymentList->to = $newDate;
        $newPaymentList->save();
        return $newPaymentList;
    }

    private function newDate($schedule, $startDate)
    {
        if (strtolower($schedule) == strtolower('Daily')) {
            $date = Carbon::parse($startDate)->addDay();
        } elseif (strtolower($schedule) == strtolower('Weekly')) {
            $date = Carbon::parse($startDate)->addWeek();
        } else {
            $date = Carbon::parse($startDate)->addMonth();
        }

        return $date;
    }
}
