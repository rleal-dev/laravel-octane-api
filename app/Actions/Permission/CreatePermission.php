<?php

namespace App\Actions\Permission;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;

class CreatePermission
{
    /**
     * Create a permission
     *
     * @param PermissionRequest $request
     *
     * @return Permission
     */
    public function execute(PermissionRequest $request): Permission
    {
        return Permission::create($request->validated());
    }
}
