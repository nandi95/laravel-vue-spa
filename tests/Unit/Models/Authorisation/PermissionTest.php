<?php

namespace Tests\Unit\Models\Authorisation;


use App\Models\Authorisation\Permission;
use App\Models\Authorisation\PermissionGroup;
use Tests\TestCase;

/**
 * Class PermissionTest
 *
 * @package Tests\Feature
 */
class PermissionTest extends TestCase
{

    /**
     * @test
     *
     * @return void
     */
    public function group_returns_the_correct_group_relation()
    {
        // Arrange
        $permission            = factory(Permission::class)->create();
        $foreignPermissionGroup = factory(PermissionGroup::class)->create();

        // Assert
        $this->assertNotSame($permission->group->getKey(), $foreignPermissionGroup->getKey());
    }
}
