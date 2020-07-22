<?php

namespace Functional\groups\commands\updateGroupLevel;

use Core\myvendor\functions\mapper\Mapper;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Group;

class UpdateGroupLevelHandler implements IMeteorHandler
{
    use CheckIfLevelIsValid;

    private $_groupModel;
    private $_mapper;

    public function __construct()
    {
        $this->_groupModel = new Group();
        $this->_mapper = new Mapper();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        $this->IsLevelValid($this->_groupModel, $request);

        $this->_mapper->updateMap($this->_groupModel, $request->all());

        return response("Level is updated successfully", 200);
    }
}
