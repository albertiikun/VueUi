<?php

namespace Core\container\port\setup\register;

trait Configurations
{
    private function RegisterConfigurations($app)
    {
        $app->configure('mail');
        $app->configure('services');
        $app->configure('auth');
        $app->configure('dbconnect');
        $app->configure('swagger-lume');
        $app->configure('filesystems');

    }
}
