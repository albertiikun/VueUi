<?php

namespace Core\container\port\setup\register;

use Core\container\port\src\middlewares\Authenticate;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;
use Nord\Lumen\Cors\CorsMiddleware;

trait Middlewares
{
    private function RegisterMiddlewares($app)
    {
        $this->RouteMiddlewares($app);
        $this->AppMiddlewares($app);
    }

    private function RouteMiddlewares($app)
    {

        $app->routeMiddleware([
            'auth' => Authenticate::class,
            'client' => CheckClientCredentials::class,
        ]);
    }

    private function AppMiddlewares($app)
    {
        $app->middleware([
            CorsMiddleware::class,
        ]);
    }
}
