<?php

namespace Functional\role\commands\register;

use Core\myvendor\defaults\job\Job as JobJob;
use Domain\entities\Permission;

class RegisterRolePermissionsJob extends JobJob
{
    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $roleName;

    public function __construct($roleName)
    {
        $this->roleName = $roleName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $getPermission = new Permission();
        $getPermission->name = "get " . $this->roleName;
        $getPermission->roleRefs = $this->roleName;
        $getPermission->save();

        $getDeletedPermission = new Permission();
        $getDeletedPermission->name = 'get-deleted ' . $this->roleName;
        $getDeletedPermission->roleRefs = $this->roleName;
        $getDeletedPermission->save();

        $registerPermission = new Permission();
        $registerPermission->name = 'register ' . $this->roleName;
        $registerPermission->roleRefs = $this->roleName;
        $registerPermission->save();

        $updateInfoPermission = new Permission();
        $updateInfoPermission->name = 'edit-info ' . $this->roleName;
        $updateInfoPermission->roleRefs = $this->roleName;
        $updateInfoPermission->save();

        $editPasswordPermission = new Permission();
        $editPasswordPermission->name = 'edit-password ' . $this->roleName;
        $editPasswordPermission->roleRefs = $this->roleName;
        $editPasswordPermission->save();

        $editUsernameOrEmailPermission = new Permission();
        $editUsernameOrEmailPermission->name = 'edit-username-email ' . $this->roleName;
        $editUsernameOrEmailPermission->roleRefs = $this->roleName;
        $editUsernameOrEmailPermission->save();

        $deactivePermisson = new Permission();
        $deactivePermisson->name = 'deactive ' . $this->roleName;
        $deactivePermisson->roleRefs = $this->roleName;
        $deactivePermisson->save();

        $activePermission = new Permission();
        $activePermission->name = 'active ' . $this->roleName;
        $activePermission->roleRefs = $this->roleName;
        $activePermission->save();

        $deletePermission = new Permission();
        $deletePermission->name = 'delete ' . $this->roleName;
        $deletePermission->roleRefs = $this->roleName;
        $deletePermission->save();
    }
}
