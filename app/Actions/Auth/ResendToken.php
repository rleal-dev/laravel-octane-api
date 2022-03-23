<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\ResendTokenRequest;
use App\Mail\VerifyEmail;
use App\Models\{PasswordReset, User};
use App\Services\AccessPin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ResendToken
{
    /**
     * Resend token for verify user.
     *
     * @param ResendTokenRequest $request
     *
     * @return void
     */
    public function execute(ResendTokenRequest $request): void
    {
        DB::transaction(function () use ($request) {
            PasswordReset::whereEmail($request->email)->delete();

            $user = User::firstWhere('email', $request->email);

            $pin = (new AccessPin)->generate($user);
            Mail::to($request->email)->send(new VerifyEmail($pin));
        });
    }
}
