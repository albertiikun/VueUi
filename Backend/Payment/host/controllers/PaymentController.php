<?php

namespace Host\controllers;

use Functional\payment\commands\assignPaymentToUser\AssignPaymentToUserHandler;
use Functional\payment\commands\createPayment\CreatePaymentHandler;
use Functional\payment\commands\deletePayment\DeletePaymentHandler;
use Functional\payment\commands\makePaymentPaidOrUnpaid\MakePaymentPaidOrUnpaidHandler;
use Functional\payment\commands\updatePayment\UpdatePaymentHandler;
use Functional\payment\queries\getPaymentByGroups\GetPaymentByGroupsHandler;
use Functional\payment\queries\getPaymentById\GetPaymentByIdHandler;
use Functional\payment\queries\getPayments\GetPaymentsHandler;
use Functional\payment\queries\getPaymentsByIdAndGroupId\GetPaymentsByIdAndGroupIdHandler;
use Functional\payment\queries\getPaymentSchedule\GetPaymentScheduleHandler;
use Functional\payment\queries\getUserAssignedPaymentsByGroupId\GetUserAssignedPaymentsByGroupIdHandler;
use Functional\payment\queries\getUserPaymentListByUserPaymentId\GetUserPaymentListByUserPaymentIdHandler;
use Functional\payment\queries\getUserPaymentsByGroupId\GetUserPaymentsByGroupIdHandler;
use Functional\payment\queries\getUsersForPayments\GetUsersForPaymentsHandler;
use Host\controllers\base\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function GetPaymentByGroups(GetPaymentByGroupsHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function GetUserPaymentsByGroupId(GetUserPaymentsByGroupIdHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function CreatePayment(CreatePaymentHandler $command, Request  $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function GetPaymentsByIdAndGroupId(GetPaymentsByIdAndGroupIdHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function GetPaymentSchedule(GetPaymentScheduleHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function AssignPaymentToUser(AssignPaymentToUserHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function GetPayments(GetPaymentsHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function GetPaymentById(GetPaymentByIdHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function UpdatePayment(UpdatePaymentHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function DeletePayment(DeletePaymentHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function GetUserAssignedPaymentsByGroupId(GetUserAssignedPaymentsByGroupIdHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function GetUserPaymentListByUserPaymentId(GetUserPaymentListByUserPaymentIdHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function GetUsersForPayments(GetUsersForPaymentsHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function MakePaymentPaidOrUnpaid(MakePaymentPaidOrUnpaidHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }
}
