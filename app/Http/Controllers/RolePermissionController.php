<?php

namespace App\Http\Controllers;

use App\Actions\Role\{AddPermission, RevokePermission};
use App\Http\Resources\PermissionCollection;
use App\Models\{Permission, Role};
use Illuminate\Http\Request;
use Throwable;

class RolePermissionController extends BaseController
{
    /**
     * Show the permissions of role.
     *
     * @param \App\Models\Role $role
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Role $role)
    {
        return new PermissionCollection($role->permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Models\Role $role
     * @param \App\Models\Permission $permission
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Role $role, AddPermission $action)
    {
        try {
            $action->execute($role, $request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on save permission!');
        }

        return $this->responseCreated('Permission saved successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Role $role
     * @param \App\Models\Permission $permission
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Role $role, Permission $permission, RevokePermission $action)
    {
        try {
            $action->execute($role, $permission);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on delete permission!');
        }

        return $this->responseOk('Permission deleted successfully!');
    }
}
