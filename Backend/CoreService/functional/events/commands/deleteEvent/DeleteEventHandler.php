<?php

namespace Functional\events\commands\deleteEvent;

use Core\myvendor\functions\auth\ThisAuth;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Event;
use Illuminate\Http\Response;

class DeleteEventHandler implements IMeteorHandler
{
    private $_eventModel;

    public function __construct()
    {
        $this->_eventModel = new Event();
    }

    public function Handler(\Illuminate\Http\Request $request): Response
    {
        ThisAuth::HasPermissionsOrDie('event delete');

        $this->_eventModel->find($request->id)->delete();

        return response('Event is deleted successfully', 200);
    }
}
