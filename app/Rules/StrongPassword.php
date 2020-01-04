<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StrongPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // more rules at: https://github.com/langleyfoxall/laravel-nist-password-rules
        $matches = null;
        // Should have at least one Uppercase letter.
        // At least one lower case letter.
        // At least one num3r1c value.
        // At least one spec|al character.
        // Must be more than 8 characters long.
        return preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[¬¦`["£€()~:;.,<>|+=_#?!@$%^&*-]).{8,}$/', $value, $matches,  PREG_UNMATCHED_AS_NULL);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('strong_password');
    }
}
