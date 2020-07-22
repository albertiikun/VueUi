<?php

namespace Functional\groups\commands\addUsers;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Group;
use Domain\entities\GroupHasUser;
use Domain\entities\User;

class AddUsersHandler implements IMeteorHandler
{
    use CheckIfIsAdded, CheckIfUserExists, CheckLimit;

    private $_GroupHasUserModel;
    private $_userModel;
    private $_groupModel;

    public function __construct()
    {
        $this->_GroupHasUserModel = new GroupHasUser();
        $this->_userModel = new User();
        $this->_groupModel = new Group();
    }
    public function Handler(\Illuminate\Http\Request $request)
    {
        $this->Check($request, $this->_GroupHasUserModel);
        $this->CheckUser($request, $this->_userModel);
        $this->CheckLimit($request, $this->_GroupHasUserModel, $this->_groupModel);

        for ($i = 0; $i < count($request->user_id); $i++) {
            $groupUser = new GroupHasUser();
            $groupUser->user_id = $request->user_id[$i];
            $groupUser->group_id = $request->group_id;
            $groupUser->save();
        }

        return response("User is added successfully");
    }
}
