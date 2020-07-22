<?php
require_once __DIR__ . '/../../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__.'/../../../persistence/database')
))->bootstrap();
/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
 */
$app = new Core\myvendor\defaults\application\MyApplication(
    dirname(__DIR__.'/../port/src/config')
);


$app->bind(Core\container\port\setup\IPort::class, Core\container\port\setup\Port::class);
$port = new Core\container\port\setup\CallPort(new Core\container\port\setup\Port(), $app);
$port->PortHandler();


return $app;
