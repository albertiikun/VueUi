<?php

namespace Functional\events\commands\createEvent;

use Carbon\Carbon;
use Core\myvendor\common\Exceptions\EventDateTimeInvalidException;
use Core\myvendor\functions\auth\ThisAuth;
use Core\myvendor\functions\mapper\Mapper;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Event;
use Illuminate\Http\Response;

class CreateEventHandler implements IMeteorHandler
{
    private $_eventModel;
    private $_mapper;

    public function __construct()
    {
        $this->_eventModel = new Event();
        $this->_mapper = new Mapper();
    }

    public function Handler(\Illuminate\Http\Request $request): Response
    {
        ThisAuth::HasPermissionsOrDie('event create');

        $from = Carbon::parse($request->from);
        $to = Carbon::parse($request->to);

        if ($from->greaterThan($to)) throw new EventDateTimeInvalidException();

        $this->_mapper->createMap($this->_eventModel, array(
            'name' => $request->name,
            'description' => $request->description,
            'color' => $request->color,
            'from' => $from,
            'to' => $to
        ));

        return response('Event is created successfully', 200);
    }
}
