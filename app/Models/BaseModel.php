<?php

namespace App\Models;

use App\Models\Traits\EnableActivityLogs;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

abstract class BaseModel extends Model
{
    use EnableActivityLogs,
        HasFactory,
        SoftDeletes,
        Filterable;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 50;
}
