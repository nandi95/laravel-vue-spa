<?php

namespace Tests\Feature;

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
     * @test
     *
     * @return void
     */
    public function oauth_providers_relation_returns_the_correct_relations()
    {
        // Arrange
        factory(OAuthProvider::class, 2)->create();
        $user = factory(User::class)->create();
        factory(OAuthProvider::class)->create(['user_id' => $user->getKey()]);

        // Assert
        $this->assertCount(1, $user->oauthProviders);
    }


    /**
     * @test
     *
     * @return void
     */
    public function deletion_deletes_relating_entities()
    {
        // Arrange
        $user = factory(User::class)->create();
        factory(OAuthProvider::class)->create(['user_id' => $user->getKey()]);

        // Act
        $user->delete();

        // Assert
        $this->assertSame(0, OAuthProvider::count());
    }
}
