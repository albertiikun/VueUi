<?php

namespace Core\container\port\setup\register;

use Nord\Lumen\Cors\CorsServiceProvider;

trait ServiceProviders
{
    private function RegisterServiceProviders($app)
    {
        $app->register(CorsServiceProvider::class);
    }
}
