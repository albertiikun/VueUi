<?php

namespace Host\controllers;

use Functional\events\commands\createEvent\CreateEventHandler;
use Functional\events\commands\deleteEvent\DeleteEventHandler;
use Functional\events\commands\editEvent\EditEventHandler;
use Functional\events\queries\getEvents\GetEventsHandler;
use Host\controllers\base\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function Get(GetEventsHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function CreateEvent(CreateEventHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function EditEvent(EditEventHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function DeleteEvent(DeleteEventHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }
}
