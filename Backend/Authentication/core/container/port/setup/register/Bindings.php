<?php

namespace Core\container\port\setup\register;

use Core\myvendor\functions\meteor\IMeteor;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Core\myvendor\functions\meteor\Meteor;
use ReflectionClass;

trait Bindings
{
    private function RegisterBindings($app)
    {
        $app->bind(IMeteor::class, Meteor::class);
        
        $app->bind(\Illuminate\Contracts\Routing\UrlGenerator::class, function ($app) {
            return new \Laravel\Lumen\Routing\UrlGenerator($app);
        });
    }
}
