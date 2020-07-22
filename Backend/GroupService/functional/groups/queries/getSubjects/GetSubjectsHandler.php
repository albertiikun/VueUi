<?php

namespace Functional\groups\queries\getSubjects;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\GroupSubject;

class GetSubjectsHandler implements IMeteorHandler
{
    private $_subjectModel;

    public function __construct()
    {
        $this->_subjectModel = new GroupSubject();
    }
    public function Handler(\Illuminate\Http\Request $request)
    {
        return $this->_subjectModel->all();
    }
}
