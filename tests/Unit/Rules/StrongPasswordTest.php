<?php

namespace Tests\Unit\Rules;

use App\Models\User;
use App\Rules\StrongPassword;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

/**
 * Class StrongPasswordTest
 *
 * @package Tests\Unit\Rules
 */
class StrongPasswordTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function password_has_to_be_strong()
    {
        // Arrange
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $validator = Validator::make(
            ['password' => 'password'],
            ['password' => new StrongPassword]
        );

        // Assert
        $this->assertFalse($validator->passes());
    }
}
