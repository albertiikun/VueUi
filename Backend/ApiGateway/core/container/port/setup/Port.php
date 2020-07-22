<?php

namespace Core\container\port\setup;

use Core\container\port\setup\register\Aliases;
use Core\container\port\setup\register\Bindings;
use Core\container\port\setup\register\Configurations;
use Core\container\port\setup\register\Defaults;
use Core\container\port\setup\register\Middlewares;
use Core\container\port\setup\register\Routers;
use Core\container\port\setup\register\ServiceProviders;
use Core\container\port\setup\register\Singletons;

class Port implements IPort
{

    use Aliases, Bindings, Configurations, Defaults, Middlewares, ServiceProviders, Singletons, Routers;
    

    public function Register($app)
    {

        $this->RegisterAliases($app);

        $this->RegisterBindings($app);

        $this->RegisterConfigurations($app);

        $this->RegisterDefaults($app);

        $this->RegisterMiddlewares($app);

        $this->RegisterServiceProviders($app);

        $this->RegisterSingletons($app);

        $this->RegisterRouters($app);
    }
}
