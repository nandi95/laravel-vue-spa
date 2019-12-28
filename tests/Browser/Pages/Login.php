<?php

namespace Tests\Browser\Pages;

/**
 * Class Login
 *
 * @package Tests\Browser\Pages
 */
class Login extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return route('api.guest.auth.login');
    }

    /**
     * Submit the form with the given credentials.
     *
     * @param \Laravel\Dusk\Browser $browser
     * @param string                $email
     * @param string                $password
     *
     * @return void
     */
    public function submit($browser, $email, $password)
    {
        $browser->type('email', $email)
                ->type('password', $password)
                ->press('Log In')
                ->pause(500);
    }
}
