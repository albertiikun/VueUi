<?php

namespace Functional\payment\queries\getPaymentByGroups;

use Carbon\Carbon;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Group;
use Domain\entities\UserPayment;

class GetPaymentByGroupsHandler implements IMeteorHandler
{
    private $_groupModel;
    private $_userPaymentModel;

    public function __construct()
    {
        $this->_groupModel = new Group();
        $this->_userPaymentModel = new UserPayment();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        $groups = $this->_groupModel
            ->where(function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->search}%")
                    ->orWhere('level', 'like', "%{$request->search}%")
                    ->orWhere('maxLevel', 'like', "%{$request->search}%")
                    ->orWhere('studentLimit', 'like', "%{$request->search}%");
            })
            ->groupBy("id")
            ->orderBy("created_at", "DESC")
            ->paginate(6);

        return response($groups, 200);
    }
}
