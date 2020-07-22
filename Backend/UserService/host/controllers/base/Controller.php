<?php

namespace Host\controllers\base;

use Core\myvendor\functions\meteor\IMeteor;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $_meteor;

    public function __construct(IMeteor $meteor)
    {
        $this->_meteor = $meteor;
    }

}
