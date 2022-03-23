<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\LoginRequest;

class Login
{
    /**
     * User Login and register token.
     *
     * @param LoginRequest $request
     *
     * @return bool|string
     */
    public function execute(LoginRequest $request): string
    {
        $credentials = $request->validated();

        if (! auth()->attempt($credentials)) {
            return false;
        }

        if (! $request->user()->email_verified_at) {
            return false;
        }

        return $request->user()->createToken('auth_token')->plainTextToken;
    }
}
