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

$router->group(['prefix' => 'api/roles', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/', 'RoleController@Get');
    $router->get('/:has-permissions', 'RoleController@GetRolePermissions');
    $router->get('/:has-not-permissions', 'RoleController@GetRoleNoPermissions');
    $router->post('/:register', 'RoleController@Register');
    $router->post('/:update', 'RoleController@Update');
    $router->delete('/:delete', 'RoleController@Delete');
    $router->post('/:assign-permission', 'RoleController@AssignPermission');
    $router->post('/:unassign-permission', 'RoleController@UnAssignPermission');
    $router->get('/:auth-role-permission',  'RoleController@GetAuthRolePermission');
});
