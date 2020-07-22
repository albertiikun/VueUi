<?php

namespace Core\container\port\setup\register;

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
    }

    private function AppMiddlewares($app)
    {
        $app->middleware([
            CorsMiddleware::class,
        ]);
    }
}
