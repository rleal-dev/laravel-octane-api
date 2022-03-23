<?php

namespace App\Http\Controllers;

use App\Actions\Permission\{CreatePermission, DeletePermission, UpdatePermission};
use App\Http\Requests\PermissionRequest;
use App\Http\Resources\{PermissionCollection, PermissionResource};
use App\Models\Permission;
use Illuminate\Http\Request;
use Throwable;

class PermissionController extends BaseController
{
    /**
     * Get the permission list.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return new PermissionCollection(
            Permission::getList($request->all())
        );
    }

    /**
     * Store a new permission.
     *
     * @param PermissionRequest  $request
     * @param CreatePermission  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PermissionRequest $request, CreatePermission $action)
    {
        try {
            $permission = $action->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on create permission!');
        }

        return $this->responseCreated(
            'Permission created successfully!',
            new PermissionResource($permission)
        );
    }

    /**
     * Get the permission.
     *
     * @param Permission $permission
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Permission $permission)
    {
        return new PermissionResource($permission);
    }

    /**
     * Update a permission information.
     *
     * @param PermissionRequest  $request
     * @param Permission $permission
     * @param UpdatePermission  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PermissionRequest $request, Permission $permission, UpdatePermission $action)
    {
        try {
            $action->execute($permission, $request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on update permission!');
        }

        return $this->responseOk(
            'Permission updated successfully!',
            new PermissionResource($permission)
        );
    }

    /**
     * Delete a permission.
     *
     * @param Permission $permission
     * @param DeletePermission $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Permission $permission, DeletePermission $action)
    {
        try {
            $action->execute($permission);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on delete permission!');
        }

        return $this->responseOk('Permission deleted successfully!');
    }
}
