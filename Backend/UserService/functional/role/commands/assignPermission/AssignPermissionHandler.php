<?php


namespace Functional\role\commands\assignPermission;

use Core\myvendor\common\Exceptions\PermissionIsAlreadyAssignedException;
use Core\myvendor\functions\auth\ThisAuth;
use Core\myvendor\functions\mapper\Mapper;
use Core\myvendor\functions\meteor\IMeteorHandler;
use Domain\entities\RoleHasPermission;
use Illuminate\Http\Request;

class AssignPermissionHandler implements IMeteorHandler
{
    private $_roleHasPermissionModel;
    private $_mapper;

    public function __construct()
    {
        $this->_roleHasPermissionModel = new RoleHasPermission();
        $this->_mapper = new Mapper();
    }

    public function Handler(\Illuminate\Http\Request $request)
    {
        ThisAuth::HasPermissionsOrDie('manage-roles');

        $this->isAlreadyExists($request);

        $this->_mapper->createMap($this->_roleHasPermissionModel, $request->all());

        return response('Permission is assigned successfully', 200);
    }

    private function isAlreadyExists(Request $request): void
    {
        $exists = $this->_roleHasPermissionModel
            ->where('permission_id', $request->permission_id)
            ->where('role_id', $request->role_id)
            ->first();

        if ($exists)
            throw new PermissionIsAlreadyAssignedException();
    }
}
