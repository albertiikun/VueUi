<?php

namespace Functional\groups\queries\getAll;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\Group;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class GetAllHandler implements IMeteorHandler
{
    private $_groupModel;

    public function __construct()
    {
        $this->_groupModel = new Group();
    }

    public function Handler(\Illuminate\Http\Request $request): Response
    {


        $groups = $this->_groupModel->select('groups.*', DB::raw('COUNT(group_has_users.id) as users'))
            ->leftJoin("group_has_users", 'group_has_users.group_id', '=', 'groups.id')
            ->leftJoin("group_subjects as subject", 'subject.id', '=', 'groups.subject_id')
            ->where(function ($query) use ($request) {
                $query->where('groups.name', 'like', "%{$request->search}%")
                    ->orWhere('subject.name', 'like', "%{$request->search}%")
                    ->orWhere('groups.level', 'like', "%{$request->search}%")
                    ->orWhere('groups.maxLevel', 'like', "%{$request->search}%")
                    ->orWhere('groups.studentLimit', 'like', "%{$request->search}%")
                    ->orWhere('subject.name', 'like', "%{$request->search}%");
            })
            ->groupBy("groups.id")
            ->orderBy("groups.created_at", "DESC")
            ->select("groups.*", "subject.name as subject", "subject.id as subjectId", DB::raw('COUNT(group_has_users.id) as users'))
            ->paginate(6);

        return response($groups, 200);
    }
}
