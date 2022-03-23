<?php

namespace App\Actions\User;

use App\Http\Requests\UserRequest;
use App\Models\User;

class UpdateUser
{
    /**
     * Update a user
     *
     * @param User $user
     * @param UserRequest $request
     *
     * @return bool
     */
    public function execute(User $user, UserRequest $request): bool
    {
        return $user->update($request->validated());
    }
}
