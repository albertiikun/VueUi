<?php

namespace Core\container\port\setup\register;

use Core\container\port\src\middlewares\Authenticate;
use Core\container\port\src\middlewares\IpRestrictionMiddleware;

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
            'ipRestriction' => IpRestrictionMiddleware::class,
        ]);
    }

    private function AppMiddlewares($app)
    {

        // $app->middleware([
        //     MeasureExecutionTime::class,
        // ]);
    }
}
