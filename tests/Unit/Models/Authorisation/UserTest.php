<?php

namespace Tests\Unit\Models\Authorisation;

use App\Models\Authorisation\Permission;
use App\Models\User;
use Illuminate\Support\Arr;
use Tests\TestCase;
use Tests\Traits\InteractsWithPermissions;

class UserTest extends TestCase
{
    use InteractsWithPermissions;

    /**
     * @var User $user
     */
    public $user;

    /**
     * @var string $nonDefaultGuard
     */
    public $nonDefaultGuard;

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->actingAs($this->user);

        $this->nonDefaultGuard = array_key_first(
            Arr::except(config('auth.guards'), config('auth.defaults.guard'))
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function user_permission_revoking_revokes_on_the_correct_guard_by_default()
    {
        // Arrange
        $existingPermission            = Permission::first();
        $newPermissionOnDifferentGuard = factory(Permission::class)->create([
            'name'       => $existingPermission->name,
            'guard_name' => $this->nonDefaultGuard
        ]);
        $this->user->givePermissionTo($newPermissionOnDifferentGuard);
        $userPermissionsCount = $this->user->permissions->count();

        // Act
        $this->user->revokePermissionTo($existingPermission);

        // Assert
        $this->assertSame($userPermissionsCount - 1, $this->user->permissions->count());
    }
}
