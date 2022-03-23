<?php

namespace App\Models;

class Project extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
    ];

    /**
     * Get the user list.
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
