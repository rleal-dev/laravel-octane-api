<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\{Register, ResendToken, VerifyEmail};
use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\{RegisterRequest, ResendTokenRequest, VerifyEmailRequest};
use Throwable;

class RegisterController extends BaseController
{
    /**
     * Perform user register.
     *
     * @param RegisterRequest  $request
     * @param Register  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request, Register $action)
    {
        try {
            $token = $action->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on user register!');
        }

        return $this->responseOk('User created successfully!', ['access_token' => $token]);
    }

    /**
     * Verify email for user registered.
     *
     * @param VerifyEmailRequest  $request
     * @param VerifyEmail  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyEmail(VerifyEmailRequest $request, VerifyEmail $action)
    {
        try {
            $token = $action->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on verify user!');
        }

        if (! $token) {
            return $this->responseNotFound('Invalid PIN');
        }

        return $this->responseOk('User verified successfully!');
    }

    /**
     * Resend token for verify user.
     *
     * @param ResendTokenRequest  $request
     * @param ResendToken  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resendToken(ResendTokenRequest $request, ResendToken $action)
    {
        try {
            $action->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on resend token!');
        }

        return $this->responseOk('Token resend successfully!');
    }
}
