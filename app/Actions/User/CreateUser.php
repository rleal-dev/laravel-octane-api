<?php

namespace App\Actions\User;

use App\Http\Requests\UserRequest;
use App\Models\User;

class CreateUser
{
    /**
     * Create a user
     *
     * @param UserRequest $request
     *
     * @return User
     */
    public function execute(UserRequest $request): User
    {
        return User::create($request->validated());
    }
}
