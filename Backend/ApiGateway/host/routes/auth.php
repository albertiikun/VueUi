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

$router->post('/api/oauth/token', 'AuthController@Login');
$router->get('/api/oauth/user', 'AuthController@User');
$router->post('/api/oauth/logout', 'AuthController@Logout');
$router->get('api/oauth/forgot-password', 'AuthController@ForgotPassword');
$router->post('api/oauth/reset-password', 'AuthController@ResetPassword');
