<?php

namespace Core\container\port\setup\register;

trait Defaults
{
    private function RegisterDefaults($app)
    {
        $app->withFacades();
    }
}
