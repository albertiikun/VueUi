<?php

namespace Core\container\port\setup\register;

use Core\myvendor\functions\meteor\IMeteor;
use Core\myvendor\functions\meteor\Meteor;

trait Bindings
{
    private function RegisterBindings($app)
    {
        $app->bind(IMeteor::class, Meteor::class);

    }
}
