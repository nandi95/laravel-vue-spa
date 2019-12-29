<?php

namespace App\Models\Authorisation;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role
 *
 * @package App\Models
 */
class Role extends \Spatie\Permission\Models\Role
{
    use SoftDeletes;
}
