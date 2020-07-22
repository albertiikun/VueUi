<?php

namespace Core\container\port\setup\register;

trait Configurations
{
    private function RegisterConfigurations($app)
    {
        $app->configure('cors');
        $app->configure('devApi');
    }
}
