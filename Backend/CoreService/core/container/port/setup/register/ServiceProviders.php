<?php

namespace Core\container\port\setup\register;

use Core\container\port\src\serviceproviders\EventServiceProvider;
use Illuminate\Mail\MailServiceProvider;

trait ServiceProviders
{
    private function RegisterServiceProviders($app)
    {
        $app->register(EventServiceProvider::class);

        $app->register(MailServiceProvider::class);
        $app->register(\SwaggerLume\ServiceProvider::class);
        $app->register(\Illuminate\Filesystem\FilesystemServiceProvider::class);

    }
}
