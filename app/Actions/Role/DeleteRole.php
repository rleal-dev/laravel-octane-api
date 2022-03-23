<?php

namespace App\Actions\Role;

use App\Models\Role;

class DeleteRole
{
    /**
     * Delete a role
     *
     * @param Role $role
     *
     * @return bool
     */
    public function execute(Role $role): bool
    {
        return $role->delete();
    }
}
