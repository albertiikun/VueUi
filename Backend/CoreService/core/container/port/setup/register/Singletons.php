<?php

namespace Core\container\port\setup\register;

use Core\myvendor\commands\Kernel;
use Core\myvendor\defaults\exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Contracts\Console\Kernel as IKernel;

trait Singletons
{
    private function RegisterSingletons($app)
    {
        $app->singleton(
            ExceptionHandler::class,
            Handler::class
        );

        $app->singleton(
            IKernel::class,
            Kernel::class
        );
    }
}
