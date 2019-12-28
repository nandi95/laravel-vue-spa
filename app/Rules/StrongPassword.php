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
        $matches = null;
        // Should have At least one Uppercase letter.
        // At least one Lower case letter.
        // At least one numeric value.
        // At least one special character.
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
        return 'Your password must be more than 8 characters long, should contain at least 1 uppercase, 1 lowercase, 1 numeric and 1 special character.';
    }
}
