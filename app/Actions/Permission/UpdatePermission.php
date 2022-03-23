<?php

namespace App\Actions\Permission;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;

class UpdatePermission
{
    /**
     * Update a permission
     *
     * @param Permission $permission
     * @param PermissionRequest $request
     *
     * @return bool
     */
    public function execute(Permission $permission, PermissionRequest $request): bool
    {
        return $permission->update($request->validated());
    }
}
