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

$router->group(['prefix' => 'api/country', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/:id', 'CountryController@GetCountryById');
    $router->get('/:cityId', 'CountryController@GetCountryByCityId');
});
