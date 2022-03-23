<?php

namespace App\Actions\Role;

use App\Models\{Permission, Role};

class RevokePermission
{
    /**
     * Delete permission from role
     *
     * @param Role $role
     * @param Permission $permission
     *
     * @return Role
     */
    public function execute(Role $role, Permission $permission): Role
    {
        return $role->revokePermissionTo($permission);
    }
}
