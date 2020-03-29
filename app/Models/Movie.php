<?php

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Movie
 *
 * @package App
 */
class Movie extends BaseModel
{
    protected $fillable = [
        'path',
        'title',
        'extension',
        'last_discovered_at',
        'duration'
    ];
}
