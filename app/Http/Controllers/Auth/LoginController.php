<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\Login;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Response;
use Throwable;

class LoginController extends BaseController
{
    /**
     * Perform user login.
     *
     * @param LoginRequest  $request
     * @param Login  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(LoginRequest $request, Login $action)
    {
        try {
            $token = $action->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on user login!');
        }

        if (! $token) {
            return $this->responseError('User or Password incorrect!', [], Response::HTTP_UNAUTHORIZED);
        }

        return $this->responseOk('Login successfully!', ['access_token' => $token]);
    }
}
