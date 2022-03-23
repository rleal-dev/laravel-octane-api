<?php

namespace App\Models\Traits;

use Ramsey\Uuid\Uuid;

trait Uuids
{
    /**
     * Boot Uuids Trait.
     *
     * @return void
     */
    public static function bootUuids()
    {
        static::creating(fn ($model) => $model->uuid = Uuid::uuid4());
    }
}
