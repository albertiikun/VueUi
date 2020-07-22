<?php

namespace Functional\groups\commands\activeUser;

use Carbon\Carbon;
use Core\myvendor\functions\mapper\Mapper;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\GroupStatus;
use Domain\entities\UserStatus;

class ActiveUserHandler implements IMeteorHandler
{
    use CheckIsGroupActive, CheckIsUserAlreadyActive;

    private $_userStatusModel;
    private $_groupStatusModel;

    public function __construct()
    {
        $this->_userStatusModel = new UserStatus();
        $this->_groupStatusModel = new GroupStatus();
    }


    public function Handler(\Illuminate\Http\Request $request)
    {

        $this->IsUserAlreadyActive($this->_groupStatusModel, $this->_userStatusModel, $request);
        $groupActiveId = $this->IsGroupActive($this->_groupStatusModel, $request);
        
        for ($i = 0; $i < count($request->user_id); $i++) {
            $userStatus = new  $this->_userStatusModel;
            $userStatus->user_id = $request->user_id[$i];
            $userStatus->groupStatus_id = $groupActiveId;
            $userStatus->isActive = true;
            $userStatus->save();
            dispatch(new SmsNotificationJob($userStatus->user_id));
        }

        return response('Users are activated successfully');
    }
}
