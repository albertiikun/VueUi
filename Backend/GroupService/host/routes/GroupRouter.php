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

$router->group(['prefix' => 'api/groups', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/', 'GroupController@Get');
    $router->post('/:create', 'GroupController@CreateGroup');
    $router->post('/:update', 'GroupController@UpdateGroup');
    $router->post('/:add-user', 'GroupController@AddUser');
    $router->get('/:users-group-id', 'GroupController@GetUsersByGroupId');
    $router->get('/:check-group-name', 'GroupController@CheckGroupNameExist');
    $router->get('/:group-sujects', 'GroupController@GetGroupSubjects');
    $router->get('/:users-to-assign', 'GroupController@GetUsersToAssign');
    $router->delete('/:unassign-user', 'GroupController@UnassignUser');
    $router->post("/:active-group", "GroupController@ActiveGroup");
    $router->get("/:actvated-groups", "GroupController@GetActivatedGroups");
    $router->post("/:active-user", "GroupController@ActiveUser");
    $router->get("/:activated-users", "GroupController@GetActivatedUsers");
    $router->post("/:unactive-user", "GroupController@UnactiveUser");
    $router->post("/:deactivate-group", "GroupController@DeactivateGroup");
    $router->post("/:update-group-level", "GroupController@UpdateGroupLevel");
    $router->get('/:user-id', 'GroupController@GetGroupsByUserId');
});
