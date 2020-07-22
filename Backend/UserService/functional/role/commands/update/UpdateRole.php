<?php

namespace Functional\role\commands\update;

use Domain\entities\Role;
use Illuminate\Http\Request;

trait UpdateRole
{
    private $_roleModel;

    public function __construct()
    {
        $this->_roleModel = new Role;
    }

    public function UpdateRole(Request $request)
    {
        $this->_roleModel = $this->_roleModel->where('id', $request->role_id)->first();
        $this->_roleModel->name = $request->name;
        $this->_roleModel->save();
    }
}
