<?php

namespace Functional\payment\queries\getPayments;

use Carbon\Carbon;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Payment;

class GetPaymentsHandler implements IMeteorHandler
{
    private $_paymentModel;

    public function __construct()
    {
        $this->_paymentModel = new Payment();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        return $this->_paymentModel
            ->leftJoin('group_service.groups as group', 'payments.group_id', '=', 'group.id')
            ->leftJoin('payment_schedules as schedule', 'payments.paymentSchedule_id', '=', 'schedule.id')
            ->select("payments.*", 'schedule.name as schedule', 'group.name as group')
            ->where(function ($query) use ($request) {
                $query->where('payments.name', 'like', "%{$request->search}%")
                    ->orWhere('payments.price', 'like', "%{$request->search}%")
                    ->orWhere('group.name', 'like', "%{$request->search}%")
                    ->orWhere('schedule.name', 'like', "%{$request->search}%");
            })
            ->orderBy("payments.created_at", "DESC")
            ->paginate($request->itemsPerPage);
    }
}
