<?php

namespace Core\container\port\setup\register;

use Core\container\port\src\serviceproviders\EventServiceProvider;
use Dusterio\LumenPassport\PassportServiceProvider as DPassportServiceProvider;
use Illuminate\Mail\MailServiceProvider;
use Laravel\Passport\PassportServiceProvider;
use Nord\Lumen\Cors\CorsServiceProvider;
use Torann\GeoIP\GeoIPServiceProvider;

trait ServiceProviders
{
    private function RegisterServiceProviders($app)
    {
        $app->register(EventServiceProvider::class);
        $app->register(MailServiceProvider::class);
        $app->register(\SwaggerLume\ServiceProvider::class);
        $app->register(PassportServiceProvider::class);
        $app->register(DPassportServiceProvider::class);
        $app->register(GeoIPServiceProvider::class);
        $app->register(CorsServiceProvider::class);
    }
}
