<?php

namespace App\Actions\Permission;

use App\Models\Permission;

class DeletePermission
{
    /**
     * Delete a permission
     *
     * @param Permission $permission
     *
     * @return bool
     */
    public function execute(Permission $permission): bool
    {
        return $permission->delete();
    }
}
