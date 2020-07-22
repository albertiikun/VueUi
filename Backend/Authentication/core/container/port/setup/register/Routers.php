<?php

namespace Core\container\port\setup\register;

use Core\myvendor\defaults\os\Slash;

trait Routers
{
    private function RegisterRouters($app)
    {

        \Dusterio\LumenPassport\LumenPassport::routes($app->router);
        \Dusterio\LumenPassport\LumenPassport::routes($app->router, ['prefix' => 'api/oauth']);

        $app->router->group([
            'namespace' => 'Host\controllers',
        ], function ($router) {
            require __DIR__.'/../../../../../host/routes/web.php';
        });
    }
}
