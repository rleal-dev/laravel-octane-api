<?php

namespace App\Actions\Role;

use App\Models\{Permission, Role};
use Illuminate\Http\Request;

class AddPermission
{
    /**
     * Add permission to role
     *
     * @param Role $role
     * @param Request $request
     *
     * @return Role
     */
    public function execute(Role $role, Request $request): Role
    {
        $permission = Permission::findOrFail($request->permission_id);

        return $role->givePermissionTo($permission);
    }
}
