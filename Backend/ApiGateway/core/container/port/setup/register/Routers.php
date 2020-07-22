<?php

namespace Core\container\port\setup\register;

trait Routers
{
    private function RegisterRouters($app)
    {
        $app->router->group([
            'namespace' => 'Host\controllers',
        ], function ($router) {
            require __DIR__ . '/../../../../../host/routes/auth.php';
        });

        $app->router->group([
            'namespace' => 'Host\controllers',
        ], function ($router) {
            require __DIR__ . '/../../../../../host/routes/user.php';
        });

        $app->router->group([
            'namespace' => 'Host\controllers',
        ], function ($router) {
            require __DIR__ . '/../../../../../host/routes/core.php';
        });

        $app->router->group([
            'namespace' => 'Host\controllers',
        ], function ($router) {
            require __DIR__ . '/../../../../../host/routes/group.php';
        });

        $app->router->group([
            'namespace' => 'Host\controllers',
        ], function ($router) {
            require __DIR__ . '/../../../../../host/routes/payment.php';
        });
    }
}
