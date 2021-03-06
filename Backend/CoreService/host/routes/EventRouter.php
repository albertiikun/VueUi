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

$router->group(['prefix' => 'api/events', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/', 'EventController@Get');
    $router->post('/:create', 'EventController@CreateEvent');
    $router->post('/:edit', 'EventController@EditEvent');
    $router->delete('/:delete', 'EventController@DeleteEvent');
});
