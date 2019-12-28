<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

/**
 * Class LoginTest
 *
 * @package Tests\Feature
 */
class LoginTest extends TestCase
{
    /**
     * @var User
     */
    protected $user;

    public function url()
    {
        return route('api.guest.auth.login');
    }

    /**
     * @inheritdoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     */
    public function authenticate()
    {
        $this->postJson($this->url(), [
            'email' => $this->user->email,
            'password' => 'password',
        ])
            ->assertSuccessful()
            ->assertJsonStructure(['token', 'expiresIn'])
            ->assertJson(['tokenType' => 'bearer']);
    }

    /**
     * @test
     */
    public function fetch_the_current_user()
    {
        $this->actingAs($this->user)
            ->getJson(route('api.dashboard.me'))
            ->assertSuccessful()
            ->assertJsonStructure(['data' => ['firstName']]);
    }

    /**
     * @test
     */
    public function log_out()
    {
        $token = $this->postJson($this->url(), [
            'email' => $this->user->email,
            'password' => 'password',
        ])
            ->json()['token'];

        $this->postJson(route('api.dashboard.logout'))
            ->assertSuccessful();

        $this->getJson("/api/user?token=$token")
            ->assertStatus(401);
    }
}
