<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\LogoutRequest;
use App\Models\Enums\LogoutType;

class Logout
{
    /**
     * User Logout.
     *
     * @param LogoutRequest $request
     *
     * @return bool
     */
    public function execute(LogoutRequest $request): bool
    {
        if ($request->logout_mode == LogoutType::CURRENT_TOKEN) {
            return $request->user()->currentAccessToken()->delete();
        }

        return $request->user()->tokens()->delete();
    }
}
