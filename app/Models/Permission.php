<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Spatie\Permission\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    use Filterable;

    /**
     * Get the permission list.
     *
     * @param array $filters
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getList($filters)
    {
        return static::filter($filters)->orderBy('name')->paginate();
    }
}
