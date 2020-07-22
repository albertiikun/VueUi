<?php

namespace Functional\groups\queries\getUsersToAssign;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\GroupHasUser;
use Domain\entities\User;

class GetUsersToAssignHandler implements IMeteorHandler
{
    private $_userModel;
    private $_groupHasUserModel;

    public function __construct()
    {
        $this->_groupHasUserModel = new GroupHasUser();
        $this->_userModel = new User();
    }
    public function Handler(\Illuminate\Http\Request $request)
    {
        $assignedUsers = $this->_groupHasUserModel->where("group_id", $request->group_id)->pluck("user_id");

        return $this->_userModel
            ->where(function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->search}%")
                    ->orWhere('lastName', 'like', "%{$request->search}%");
            })
            ->whereNotIn("id", $assignedUsers)
            ->select("id", "name", "lastName", "email")
            ->take(5)->get();
    }
}
