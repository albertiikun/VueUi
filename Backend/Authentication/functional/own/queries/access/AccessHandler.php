<?php
namespace Functional\own\queries\access;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request as SRequest;

class AccessHandler implements IMeteorHandler
{

    public function Handler(Request $request)
    {
        return $this->getAuthenticated($request);
    }

    public function getAuthenticated($request)
    {
        global $app;

        $userToken = $request->header('user-authorization');

        Route::get('api/oauth/check', ['middleware' => 'auth:api', 'uses' => 'Host\Controllers\AuthController@CheckAuth']);

        $send = SRequest::create('/api/oauth/check', 'GET', [], [], [], ['HTTP_AUTHORIZATION' => $userToken]);

        $response = $app->dispatch($send);

        return $response->getContent();
    }
}
