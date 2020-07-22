<?php

namespace Core\container\port\setup\register;

trait Routers
{
    private function RegisterRouters($app)
    {

        $app->router->group([
            'namespace' => 'Host\controllers',
        ], function ($router) {
            require $this->ToRouter('PaymentRouter.php');
        });
    }



    public function ToRouter($webName)
    {
        $from = implode(DIRECTORY_SEPARATOR, explode(DIRECTORY_SEPARATOR, __DIR__, -5));
        return $from . '/host/routes/' . $webName;
    }
}
