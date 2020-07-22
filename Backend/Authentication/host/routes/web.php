<?php
namespace Host\routes;

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

$router->get('/', function () use ($router) {
    return 'ok';
});

$router->get('api/oauth/access', ['middleware' => 'client', 'uses' => 'AuthController@access']);

$router->group(['prefix' => 'api/oauth', 'middleware' => 'auth:api'], function () use ($router) {
    $router->get('user','AuthController@User');
    $router->get('logged-in', 'AuthController@LoggedIn');
    $router->post('logout', 'AuthController@Logout');
    $router->post('logout-all-devices', 'AuthController@LogoutAllDevices');
});

$router->group(['prefix' => 'api/oauth'], function () use ($router) {
    $router->get('forgot-password', 'AuthController@ForgotPassword');
    $router->post('reset-password', 'AuthController@ResetPassword');
    $router->get('request-confirm-email', 'AuthController@RequestConfirmEmail');
    $router->post('confirm-email', 'AuthController@ConfirmEmail');
});