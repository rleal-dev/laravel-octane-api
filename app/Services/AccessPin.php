<?php

namespace App\Services;

use App\Models\{PasswordReset, User};

class AccessPin
{
    /**
     * Generate PIN token.
     *
     * @return string
     */
    public function generate(User $user)
    {
        $pin = rand(100000, 999999);

        PasswordReset::create([
            'email' => $user->email,
            'token' => $pin,
            'created_at' => now(),
        ]);

        return $pin;
    }
}
