<?php

namespace Functional\groups\commands\updateGroup;

use Core\myvendor\functions\mapper\Mapper;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Group;
use Domain\entities\GroupHasUser;

class UpdateGroupHandler implements IMeteorHandler
{
    use CheckGroupUpdates;

    private $_groupModel;
    private $_groupHasUserModel;
    private $_mapper;

    public function __construct()
    {
        $this->_groupModel = new Group();
        $this->_groupHasUserModel = new GroupHasUser();
        $this->_mapper = new Mapper();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        $this->CheckGroup($this->_groupModel, $this->_groupHasUserModel, $request);

        $this->_mapper->updateMap($this->_groupModel, $request->all());

        return response("Group is successfully updated", 200);
    }
}
