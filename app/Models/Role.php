<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Spatie\Permission\Models\Role as RoleModel;

class Role extends RoleModel
{
    use Filterable;

    /**
     * Get the role list.
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
