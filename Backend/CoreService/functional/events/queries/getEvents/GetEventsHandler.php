<?php

namespace Functional\events\queries\getEvents;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Event;

class GetEventsHandler implements IMeteorHandler
{
    private $_eventModel;

    public function __construct()
    {
        $this->_eventModel = new Event();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        return $this->_eventModel->all();
    }
}
