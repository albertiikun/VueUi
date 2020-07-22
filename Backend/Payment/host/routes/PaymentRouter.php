<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->group(['prefix' => 'api/payments', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/', 'PaymentController@GetPayments');
    $router->get('/:id', 'PaymentController@GetPaymentById');
    $router->post('/:update', 'PaymentController@UpdatePayment');
    $router->delete('/:delete', 'PaymentController@DeletePayment');
    $router->get('/:id-group-id', 'PaymentController@GetPaymentsByIdAndGroupId');
    $router->get('/:payment-schedule', 'PaymentController@GetPaymentSchedule');
    $router->post('/:assign-payment', 'PaymentController@AssignPaymentToUser');
    $router->post('/:create', 'PaymentController@CreatePayment');
    $router->get('/:get-by-groups', 'PaymentController@GetPaymentByGroups');
    $router->get('/:get-users-by-group-id', 'PaymentController@GetUserPaymentsByGroupId');
    $router->get('/:user-payments-group-id', 'PaymentController@GetUserAssignedPaymentsByGroupId');
    $router->get('/:user-payment-list', 'PaymentController@GetUserPaymentListByUserPaymentId');
    $router->get('/:users', 'PaymentController@GetUsersForPayments');
    $router->post('/:make-paid-unpaid-id', 'PaymentController@MakePaymentPaidOrUnpaid');
});
