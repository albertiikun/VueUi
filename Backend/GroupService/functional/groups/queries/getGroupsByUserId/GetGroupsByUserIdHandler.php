<?php

namespace Functional\groups\queries\getGroupsByUserId;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GetGroupsByUserIdHandler implements IMeteorHandler
{
    use CheckUserExists;

    private $_userModel;

    public function __construct()
    {
        $this->_userModel = new User();
    }

    public function Handler(Request $request): Response
    {
        $this->ExistsUser($this->_userModel, $request->userId);
        return response('oke');
    }
}
