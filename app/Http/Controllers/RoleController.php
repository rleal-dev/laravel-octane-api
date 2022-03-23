<?php

namespace App\Http\Controllers;

use App\Actions\Role\{CreateRole, DeleteRole, UpdateRole};
use App\Http\Requests\RoleRequest;
use App\Http\Resources\{RoleCollection, RoleResource};
use App\Models\Role;
use Illuminate\Http\Request;
use Throwable;

class RoleController extends BaseController
{
    /**
     * Get the role list.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return new RoleCollection(
            Role::getList($request->all())
        );
    }

    /**
     * Store a new role.
     *
     * @param RoleRequest  $request
     * @param CreateRole  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleRequest $request, CreateRole $action)
    {
        try {
            $role = $action->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on create role!');
        }

        return $this->responseCreated(
            'Role created successfully!',
            new RoleResource($role)
        );
    }

    /**
     * Get the role.
     *
     * @param Role $role
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    /**
     * Update a role information.
     *
     * @param RoleRequest  $request
     * @param Role $role
     * @param UpdateRole  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RoleRequest $request, Role $role, UpdateRole $action)
    {
        try {
            $action->execute($role, $request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on update role!');
        }

        return $this->responseOk(
            'Role updated successfully!',
            new RoleResource($role)
        );
    }

    /**
     * Delete a role.
     *
     * @param Role $role
     * @param DeleteRole $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Role $role, DeleteRole $action)
    {
        try {
            $action->execute($role);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on delete role!');
        }

        return $this->responseOk('Role deleted successfully!');
    }
}
