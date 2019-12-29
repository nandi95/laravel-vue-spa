<?php

namespace Tests\Unit\Models;

use App\Models\OAuthProvider;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class UserTest
 *
 * @package Tests\Feature
 */
class UserTest extends TestCase
{
    /**
     * @var User $user
     */
    public $user;

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     *
     * @return void
     */
    public function oauth_providers_relation_returns_the_correct_relations()
    {
        // Arrange
        factory(OAuthProvider::class, 2)->create();
        factory(OAuthProvider::class)->create(['user_id' => $this->user->getKey()]);

        // Assert
        $this->assertCount(1, $this->user->oauthProviders);
    }


    /**
     * @test
     *
     * @return void
     *
     * @throws \Exception
     */
    public function deletion_deletes_relating_entities()
    {
        // Arrange
        factory(OAuthProvider::class)->create(['user_id' => $this->user->getKey()]);

        // Act
        $this->user->delete();

        // Assert
        $this->assertSame(0, OAuthProvider::count());
    }
}
