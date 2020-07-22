<?php

namespace Host\controllers;

use Host\controllers\base\Controller;
use Host\controllers\base\GuzzleHttp;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use GuzzleHttp;

    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('devApi.services.payment');
    }

    public function GetPaymentByGroups(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/payments/:get-by-groups', $request);
    }

    public function GetUserPaymentsByGroupId(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/payments/:get-users-by-group-id', $request);
    }

    public function CreatePayment(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/payments/:create', $request);
    }

    public function GetPaymentsByIdAndGroupId(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/payments/:id-group-id', $request);
    }

    public function GetPaymentSchedule(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/payments/:payment-schedule', $request);
    }

    public function AssignPaymentToUser(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/payments/:assign-payment', $request);
    }

    public function GetPayments(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/payments/', $request);
    }

    public function GetPaymentById(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/payments/:id', $request);
    }

    public function UpdatePayment(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/payments/:update', $request);
    }

    public function DeletePayment(Request $request)
    {
        return $this->httpDelete($this->baseUrl, 'api/payments/:delete', $request);
    }

    public function GetUserAssignedPaymentsByGroupId(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/payments/:user-payments-group-id', $request);
    }

    public function GetUserPaymentListByUserPaymentId(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/payments/:user-payment-list', $request);
    }

    public function MakePaymentPaidOrUnpaid(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/payments/:make-paid-unpaid-id', $request);
    }
}
