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

$router->get('/api/gender', 'CoreController@GetGenders');
$router->get('/api/city', 'CoreController@GetCities');
$router->get('/api/country/:id', 'CoreController@GetCountryById');
$router->get('/api/country/:cityId', 'CoreController@GetCountryByCityId');



$router->group(['prefix' => 'api/events'], function () use ($router) {
    $router->get('/', 'CoreController@GetEvents');
    $router->post('/:create', 'CoreController@CreateEvent');
    $router->post('/:edit', 'CoreController@EditEvent');
    $router->delete('/:delete', 'CoreController@DeleteEvent');
});
