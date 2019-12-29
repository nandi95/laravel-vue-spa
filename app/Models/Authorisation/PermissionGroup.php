<?php

namespace App\Models\Authorisation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class PermissionGroup
 *
 * @package App\Models
 */
class PermissionGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * PermissionGroup constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('permission.table_names.permission_groups'));
    }

    /**
     * Get permissions the group has.
     *
     * @return HasMany
     */
    public function permissions(): HasMany
    {
        return $this->hasMany(
            Permission::class,
            (new Permission)->foreignKey
        );
    }
}
