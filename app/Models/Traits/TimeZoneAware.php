<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Support\Carbon;

/**
 * Trait TimeZoneAware
 *
 * @package App\Traits
 */
trait TimeZoneAware
{
    /**
     * @param string $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        $value = parent::__get($key);

        if ($value instanceof Carbon
            && isset(auth()->user()->timezone)
            && isset($this->timezoneAwareDates)
            && in_array($key, $this->timezoneAwareDates)
        ) {
            $timezone = (string) (auth()->user()->timezone ?? 'UTC');
            $value->setTimezone($timezone);
        }

        return $value;
    }


    /**
     * @param Carbon|string $dateTime
     * @param User          $user
     *
     * @return Carbon
     */
    public function setTimezone($dateTime, User $user = null)
    {
        if (is_null($dateTime)) {
            return $dateTime;
        }
        $dateTime = Carbon::parse($dateTime);
        if ($user) {
            $timezone = (string) ($user->settings->timezone ?? 'UTC');
        } else {
            $timezone = (string) (auth()->user()->settings->timezone ?? 'UTC');
        }

        $dateTime->setTimezone($timezone);
        return $dateTime;
    }
}
