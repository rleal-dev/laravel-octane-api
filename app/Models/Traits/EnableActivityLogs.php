<?php

namespace App\Models\Traits;

use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

trait EnableActivityLogs
{
    use LogsActivity;

    /**
     * Log changes that has actually changed after the update.
     *
     * @var bool
     */
    protected static $logOnlyDirty = true;

    /**
     * Allow storing empty logs. Storing empty logs can happen when you only
     * want to log a certain attribute but only another changes.
     *
     * @var bool
     */
    protected static $submitEmptyLogs = false;

    /**
     * The attributes for save logs.
     *
     * @var array
     */
    protected static $logAttributes = ['*'];

    /**
     * The attributes that will be ignored when saving the logs.
     *
     * @var array
     */
    protected static $logExceptAttributes = [
        'remember_token',
        'access_number',
        'last_login_at',
        'updated_at',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }

    /**
     * Allow you to fill properties and add custom fields before the activity is saved.
     *
     * @param Activity $activity
     * @param string $eventName
     *
     * @return void
     */
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put(
            'ip_address', request()->ip()
        );

        if ($eventName == 'deleted') {
            $activity->properties = $activity->properties->put(
                'motive', request()->motive
            );
        }
    }
}
