<?php

namespace App\Models;

use App\Models\Traits\TimeZoneAware;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 *
 * @package App\Models
 */
class BaseModel extends Model
{
    use TimeZoneAware;

    /**
     * Dates that should be adjusted to user's timezone.
     *
     * @var array
     */
    protected $timezoneAwareDates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * BaseModel constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->casts = array_merge(
            [
                'created_at' => 'datetime',
                'updated_at' => 'datetime',
                'deleted_at' => 'datetime',
            ],
            $this->casts
        );

        $this->hidden = array_merge(
            ['laravel_through_key'],
            $this->hidden
        );
    }
}
