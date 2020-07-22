<?php

namespace Functional\groups\commands\activeGroup;

use Carbon\Carbon;
use Core\myvendor\functions\mapper\Mapper;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\GroupStatus;

class ActiveGroupHandler implements IMeteorHandler
{
    use IsAlreadyActivated;
    private $_groupStatusModel;
    private $_mapper;

    public function __construct()
    {
        $this->_groupStatusModel = new GroupStatus();
        $this->_mapper = new Mapper();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        $from = Carbon::parse($request->from);
        $to = Carbon::parse($request->to);

        $this->IsAlreadyActivatedGroup($this->_groupStatusModel, $request, $from, $to);

        $this->_mapper->createMap($this->_groupStatusModel, array('from' => $from, 'to' => $to, 'group_id' => $request->group_id));

        return response("Group is activated successfully", 200);
    }
}
