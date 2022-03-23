<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    public function name($value)
    {
        return $this->where('name', 'LIKE', "%$value%");
    }

    public function email($value)
    {
        return $this->where('name', 'LIKE', "%$value%");
    }
}
