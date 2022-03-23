<?php

namespace App\Http\Controllers;

use App\Actions\User\{CreateUser, DeleteUser, UpdateUser};
use App\Http\Requests\UserRequest;
use App\Http\Resources\{UserCollection, UserResource};
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class UserController extends BaseController
{
    /**
     * Get the user list.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return new UserCollection(
            User::getList($request->all())
        );
    }

    /**
     * Store a new user.
     *
     * @param UserRequest  $request
     * @param CreateUser  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request, CreateUser $action)
    {
        try {
            $user = $action->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on create user!');
        }

        return $this->responseCreated(
            'User created successfully!',
            new UserResource($user)
        );
    }

    /**
     * Get the user.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update a user information.
     *
     * @param UserRequest  $request
     * @param User $user
     * @param UpdateUser  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, User $user, UpdateUser $action)
    {
        try {
            $action->execute($user, $request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on update user!');
        }

        return $this->responseOk(
            'User updated successfully!',
            new UserResource($user)
        );
    }

    /**
     * Delete a user.
     *
     * @param User $user
     * @param DeleteUser $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user, DeleteUser $action)
    {
        try {
            $action->execute($user);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on delete user!');
        }

        return $this->responseOk('User deleted successfully!');
    }
}
