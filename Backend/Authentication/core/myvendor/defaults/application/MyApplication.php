<?php
namespace Core\myvendor\defaults\application;

use Core\myvendor\defaults\os\Slash;
use Laravel\Lumen\Application;

class MyApplication extends Application
{
    public function databasePath($path = '')
    {
        return __DIR__.'/../../../../persistence/database';
    }
}