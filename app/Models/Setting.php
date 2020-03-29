<?php

namespace App\Models;

use App\Models\BaseModel;

/**
 * Class Setting
 *
 * @package App
 */
class Setting extends BaseModel
{
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'media_path'
    ];
}
