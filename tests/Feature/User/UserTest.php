<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Auth\Events\Authenticated;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserTest
 *
 * @package Tests\Feature\User
 */
class UserTest extends TestCase
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
    public function get_user()
    {
        // Act
        $response = $this->getJson(route('api.dashboard.me'));

        // Assert
        $response->assertSuccessful();
        $response->assertJsonStructure(['data' => ['photoUrl', 'firstName']]);
    }
}
