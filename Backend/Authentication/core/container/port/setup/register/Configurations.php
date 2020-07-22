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
        $app->configure('geoip');
        $app->configure('cors');
        $app->configure('swagger-lume');

    }
}
