<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Models\{PasswordReset, User};
use Illuminate\Support\Facades\DB;

class VerifyEmail
{
    /**
     * Verify user email for activate user.
     *
     * @param VerifyEmailRequest $request
     *
     * @return bool
     */
    public function execute(VerifyEmailRequest $request): bool
    {
        return DB::transaction(function () use ($request) {
            $token = PasswordReset::firstWhere('token', $request->token);

            if (! $token) {
                return false;
            }

            $user = User::firstWhere('email', $token->email);
            $user->email_verified_at = now()->getTimestamp();
            $user->save();

            return PasswordReset::whereToken($request->token)->delete();
        });
    }
}
