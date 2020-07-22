<?php

namespace Persistence\database\seeds\base;

class Base
{
    use Users, Roles, UserRoles, Permissions, RoleHasPermissions, Factory;

    public function __construct()
    {
        $this->users();
        $this->roles();
        $this->userRoles();
        $this->permissions();
        $this->RoleHasPermissions();
        $this->factory();
    }
}
