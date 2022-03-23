<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\VerifyEmail;
use App\Models\User;
use App\Services\AccessPin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Register
{
    /**
     * Create user account.
     *
     * @param RegisterRequest $request
     *
     * @return string
     */
    public function execute(RegisterRequest $request): string
    {
        return DB::transaction(function () use ($request) {
            $user = User::create($request->validated());

            $pin = (new AccessPin)->generate($user);
            Mail::to($request->email)->send(new VerifyEmail($pin));

            return $user->createToken('auth_token')->plainTextToken;
        });
    }
}
