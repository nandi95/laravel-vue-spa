<?php

namespace App\Models\Authorisation;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Permission
 *
 * @package App\Models
 */
class Permission extends \Spatie\Permission\Models\Permission
{
    /**
     * @var string $foreignKey
     */
    public $foreignKey;

    /**
     * Permission constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->foreignKey = config('permission.table_names.permission_groups') . '_id';
    }

    /**
     * Get the group the permission belongs to.
     *
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(PermissionGroup::class, $this->foreignKey);
    }
}
