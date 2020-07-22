<?php

namespace Functional\groups\commands\createGroup;

use Core\myvendor\functions\mapper\Mapper;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Group;

class CreateGroupHandler implements IMeteorHandler
{
    private $_groupModel;
    private $_mapper;

    public function __construct()
    {
        $this->_groupModel = new Group();
        $this->_mapper = new Mapper();
    }
    public function Handler(\Illuminate\Http\Request $request)
    {
        $this->_mapper->createMap($this->_groupModel, $request->all());

        return response('Group is added successfully', 200);
    }
}
