<?php

namespace Tests\Unit\Rules;

use App\Models\User;
use App\Rules\IsNewPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

/**
 * Class IsNewPasswordTest
 *
 * @package Tests\Unit\Rules
 */
class IsNewPasswordTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function password_cannot_be_same_as_old()
    {
        // Arrange
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $validator = Validator::make(
            ['password' => 'password'],
            ['password' => new IsNewPassword]
        );

        // Assert
        $this->assertFalse($validator->passes());
    }
}
