<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class RoleFilter extends ModelFilter
{
    public function name($value)
    {
        return $this->where('name', 'LIKE', "%$value%");
    }
}
