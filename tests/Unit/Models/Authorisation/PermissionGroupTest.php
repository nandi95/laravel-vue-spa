<?php

namespace Tests\Unit\Models\Authorisation;

use App\Models\Authorisation\Permission;
use App\Models\Authorisation\PermissionGroup;
use App\Models\User;
use Tests\TestCase;
use Tests\Traits\InteractsWithPermissions;

/**
 * Class PermissionGroupTest
 *
 * @package Tests\Unit\Models\Authorisation
 */
class PermissionGroupTest extends TestCase
{
    use InteractsWithPermissions;

    /**
     * @test
     *
     * @return void
     */
    public function permissions_returns_the_correct_permissions()
    {
        // Arrange
        $permissionGroup = factory(PermissionGroup::class)->create();
        factory(Permission::class, 2)->create([(new Permission)->foreignKey => $permissionGroup->getKey()]);
        factory(Permission::class)->create();

        // Assert
        $this->assertCount(2, $permissionGroup->permissions);
    }
}
