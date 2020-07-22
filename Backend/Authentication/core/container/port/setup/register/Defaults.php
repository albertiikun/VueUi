<?php

namespace Core\container\port\setup\register;

use Carbon\Carbon;
use Dusterio\LumenPassport\LumenPassport;
use Laravel\Passport\Passport;

trait Defaults
{
    private function RegisterDefaults($app)
    {
        $app->withFacades();
        $app->withEloquent();

        LumenPassport::allowMultipleTokens();

        // Second parameter is the client Id
        LumenPassport::tokensExpireIn(Carbon::now()->addDay(1), 1);

        Passport::tokensCan([
            'user' => 'User Service',
            'group' => 'Group Service',
        ]);
    }
}
