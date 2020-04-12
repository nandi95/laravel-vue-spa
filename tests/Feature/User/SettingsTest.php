<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

/**
 * Class SettingsTest
 *
 * @package Tests\Feature\User
 */
class SettingsTest extends TestCase
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->actingAs($this->user);
    }

    /**
     * @test
     *
     * @return void
     */
    public function update_profile_info()
    {
        // Act
        $response = $this->patchJson('/api/settings/profile', [
            'firstName' => 'Test',
            'email'     => 'test@test.app',
        ]);

        // Assert
        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => ['firstName']]);
        $this->assertDatabaseHas('users', [
            'id'         => $this->user->getKey(),
            'first_name' => 'Test',
            'email'      => 'test@test.app',
        ]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function update_password()
    {
        // Act
        $response = $this->patchJson('/api/settings/password', [
            'old_password'              => 'password',
            'password'              => 'updated-password',
            'password_confirmation' => 'updated-password',
        ]);

        // Assert
        $response->assertSuccessful();
        $this->assertTrue(Hash::check('updated-password', $this->user->refresh()->password));
    }
}
