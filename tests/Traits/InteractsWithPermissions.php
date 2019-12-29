<?php

namespace Tests\Traits;

use App\Models\Authorisation\Permission;
use App\Models\User;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

/**
 * Trait InteractsWithPermissions
 *
 * @package Tests\Traits
 */
trait InteractsWithPermissions
{
    /**
     * Initialise the trait
     *
     * @return void
     */
    public function setupInteractsWithPermissionsTrait()
    {
        $this->seed('PermissionSeeder');
    }

    /**
     * Set the currently logged in user for the application.
     *
     * @param UserContract $user
     * @param string|null  $driver
     * @return User $user
     */
    public function actingAs(UserContract $user, $driver = null)
    {
        $this->be($user, $driver);
        return $user->givePermissionTo(Permission::get());
    }
}
