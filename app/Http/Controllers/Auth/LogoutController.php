<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\Logout;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\LogoutRequest;
use Throwable;

class LogoutController extends BaseController
{
    /**
     * Perform user logout.
     *
     * @param LogoutRequest  $request
     * @param Logout  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(LogoutRequest $request, Logout $action)
    {
        try {
            $action->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on user logout!');
        }

        return $this->responseOk('Logout successfully!');
    }
}
