<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * Class RegisterTest
 *
 * @package Tests\Feature
 */
class RegisterTest extends TestCase
{
    /**
     * @test
     */
    public function can_register()
    {
        // Arrange
        Notification::fake();

        // Act
        $response = $this->postJson(route('api.guest.auth.register'), factory(User::class)->state("toRegister")->make()->getAttributes());

        // Assert
        $response->assertSuccessful()
            ->assertJsonStructure(new User instanceof MustVerifyEmail ? ['status'] : ['data' => ['id', 'email']]);
    }

    /**
     * @test
     */
    public function can_not_register_with_existing_email()
    {
        // Arrange
        factory(User::class)->create(['email' => 'test@test.app']);
        $data = factory(User::class)->state("toRegister")->make(['email' => 'test@test.app'])->getAttributes();

        // Act
        $response = $this->postJson(route('api.guest.auth.register'), $data);

        // Assert
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }


    /**
     * @test
     */
    public function verify_email_sent_on_register()
    {
        // Arrange
        Notification::fake();

        // Act
        $this->postJson(route('api.guest.auth.register'), factory(User::class)->state("toRegister")->make()->getAttributes());

        // Assert
        Notification::assertSentTo(User::first(), VerifyEmail::class);
    }
}
