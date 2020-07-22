<?php

namespace Host\Controllers;

use Functional\swagger\commands\register\SwaggerHandler;
use Host\controllers\base\Controller;
use Illuminate\Http\Request;

class SwaggerController extends Controller
{
    public function Register(SwaggerHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

}
