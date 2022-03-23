<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\{ResetPassword, SendPasswordToken};
use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\{ResetPasswordRequest, TokenPasswordRequest};
use Throwable;

class ResetPasswordController extends BaseController
{
    /**
     * Send the password reset token.
     *
     * @param TokenPasswordRequest $request
     * @param SendPasswordToken  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function token(TokenPasswordRequest $request, SendPasswordToken $action)
    {
        try {
            $action->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on send password reset token!');
        }

        return $this->responseOk('Password reset token sent successfully!');
    }

    /**
     * Reset the user password.
     *
     * @param ResetPasswordRequest $request
     * @param SendPasswordToken  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(ResetPasswordRequest $request, ResetPassword $action)
    {
        try {
            $response = $action->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on send password reset token!');
        }

        if (! $response) {
            return $this->responseNotFound('Token not exists or expired!');
        }

        return $this->responseOk('Password reseted successfully!');
    }
}
