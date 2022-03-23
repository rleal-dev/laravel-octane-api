<?php

namespace App\Actions\Role;

use App\Http\Requests\RoleRequest;
use App\Models\Role;

class UpdateRole
{
    /**
     * Update a role
     *
     * @param Role $role
     * @param RoleRequest $request
     *
     * @return bool
     */
    public function execute(Role $role, RoleRequest $request): bool
    {
        return $role->update($request->validated());
    }
}
