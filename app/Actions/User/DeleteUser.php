<?php

namespace App\Actions\User;

use App\Models\User;

class DeleteUser
{
    /**
     * Delete a user
     *
     * @param User $user
     *
     * @return bool
     */
    public function execute(User $user): bool
    {
        return $user->delete();
    }
}
