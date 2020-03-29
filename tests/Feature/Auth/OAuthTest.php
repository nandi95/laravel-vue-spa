<?php

namespace Tests\Feature;

use App\Models\User;
use Mockery;
use Tests\TestCase;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use PHPUnit\Framework\Assert as PHPUnit;
use Illuminate\Testing\TestResponse;
use Laravel\Socialite\Two\User as SocialiteUser;

/**
 * Class OAuthTest
 *
 * @package Tests\Feature
 */
class OAuthTest extends TestCase
{
    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        TestResponse::macro('assertText', function($text) {
            PHPUnit::assertTrue(Str::contains($this->getContent(), $text), "Expected text [{$text}] not found.");

            return $this;
        });

        TestResponse::macro('assertTextMissing', function($text) {
            PHPUnit::assertFalse(Str::contains($this->getContent(), $text), "Expected missing text [{$text}] found.");

            return $this;
        });
    }

//    /**
//     * @test
//     *
//     * @return void
//     */
//    public function redirect_to_provider()
//    {
//        $this->mockSocialite('github');
//
//        $this->postJson('/api/oauth/github')
//            ->assertSuccessful()
//            ->assertJson(['url' => 'https://url-to-provider']);
//    }

    /**
     * @test
     *
     * @return void
     */
    public function create_user_and_return_token()
    {
        // Arrange
        $this->mockSocialite('github', [
            'id'           => '123',
            'first_name'   => 'Test',
            'last_name'    => 'User',
            'email'        => 'test@example.com',
            'token'        => 'access-token',
            'refreshToken' => 'refresh-token',
        ]);
        $this->withoutExceptionHandling();

        // Act
        $response = $this->get(route('api.guest.oauth.callback', 'github'));

        // Assert
        $response->assertText('token');
        $response->assertSuccessful();
        $this->assertDatabaseHas('users', [
            'first_name' => 'Test',
            'last_name'  => 'User',
            'email'      => 'test@example.com',
        ]);
        $this->assertDatabaseHas('oauth_providers', [
            'user_id'          => User::first()->getKey(),
            'provider'         => 'github',
            'provider_user_id' => '123',
            'access_token'     => 'access-token',
            'refresh_token'    => 'refresh-token',
        ]);
    }

    /**
     * @test
     */
    public function update_user_and_return_token()
    {
        $user = factory(User::class)->create(['email' => 'test@example.com']);
        $user->oauthProviders()->create([
            'provider'         => 'github',
            'provider_user_id' => '123',
        ]);

        $this->mockSocialite('github', [
            'id'           => '123',
            'email'        => 'test@example.com',
            'token'        => 'updated-access-token',
            'refreshToken' => 'updated-refresh-token',
        ]);

        $this->get('/api/oauth/github/callback')
            ->assertText('token')
            ->assertSuccessful();

        $this->assertDatabaseHas('oauth_providers', [
            'user_id'       => $user->getKey(),
            'access_token'  => 'updated-access-token',
            'refresh_token' => 'updated-refresh-token',
        ]);
    }

    /**
     * @test
     */
    public function can_not_create_user_if_email_is_taken()
    {
        factory(User::class)->create(['email' => 'test@example.com']);

        $this->mockSocialite('github', ['email' => 'test@example.com']);

        $this->get('/api/oauth/github/callback')
            ->assertText('Email already taken.')
            ->assertTextMissing('token')
            ->assertStatus(400);
    }

    /**
     * @param string $provider
     * @param null $user
     *
     * @return void
     */
    protected function mockSocialite($provider, $user = null)
    {
        $mock = Socialite::shouldReceive('stateless')
            ->andReturn(Mockery::self())
            ->shouldReceive('driver')
            ->with($provider)
            ->andReturn(Mockery::self());

        if ($user) {
            $mock->shouldReceive('user')
                ->andReturn((new SocialiteUser)->setRaw($user)->map($user));
        } else {
            $mock->shouldReceive('redirect')
                ->andReturn(redirect('https://url-to-provider'));
        }
    }
}
