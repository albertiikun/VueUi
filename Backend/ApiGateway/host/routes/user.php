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
// Users
$router->group(['prefix' => 'api/users'], function () use ($router) {
    $router->post(':register', 'UserController@RegisterUser');
    $router->get(':email', 'UserController@CheckEmailExist');
    $router->get(':username', 'UserController@CheckUsernameExist');
    $router->put(':update-password', 'UserController@UpdatePassword');
    $router->get('/', 'UserController@GetUsers');
    $router->get(':id', 'UserController@GetUserById');
    $router->get(':deleted', 'UserController@GetDeletedUsers');
    $router->delete(':delete', 'UserController@DeleteUser');
    $router->delete('/:delete-permanently', 'UserController@DeletePermanently');
    $router->post(':undelete', 'UserController@UndeleteUser');
    $router->put(':update', 'UserController@UpdateUser');
    $router->put('/:update-username-email', 'UserController@UpdateUsernameAndEmail');
    $router->get('/:username-email-id', 'UserController@GetUsernameAndEmail');
});

$router->group(['prefix' => 'api/roles'], function () use ($router) {
    $router->get('/', 'UserController@GetRoles');
    $router->get('/:has-permissions', 'UserController@GetRolePermissions');
    $router->get('/:has-not-permissions', 'UserController@GetRoleNoPermissions');
    $router->post('/:assign-permission', 'UserController@AssignPermission');
    $router->post('/:unassign-permission', 'UserController@UnAssignPermission');
    $router->post('/:register', 'UserController@RegisterRole');
    $router->delete('/:delete', 'UserController@DeleteRole');
    $router->get('/:auth-role-permission',  'UserController@GetAuthRolePermission');

});
