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

/// Users


$router->group(['prefix' => 'api/users', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/', 'UserController@Get');
    $router->get('/:id', 'UserController@GetById');
    $router->get('/:deleted', 'UserController@GetDeleted');
    $router->get('/:deleted-id', 'UserController@GetDeletedById');
    $router->post('/:register', 'UserController@Register');
    $router->put('/:update', 'UserController@Update');
    $router->put('/:update-password', 'UserController@UpdatePassword');
    $router->delete('/:delete', 'UserController@Delete');
    $router->delete('/:delete-permanently', 'UserController@DeletePermanently');
    $router->post('/:undelete', 'UserController@Undelete');
    $router->post('/:set-user-ip-restriction', 'UserController@SetUserIpRestriction');
    $router->get('/:email', 'UserController@CheckEmailExist');
    $router->get('/:username', 'UserController@CheckUsernameExist');
    $router->put('/:update-username-email', 'UserController@UpdateUsernameAndEmail');
    $router->get('/:username-email-id', 'UserController@GetUsernameAndEmailById');
});
