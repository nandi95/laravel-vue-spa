<?php

namespace Tests\Browser;

use Tests\DuskTestCase;

/**
 * Class WelcomeTest
 *
 * @package Tests\Browser
 */
class WelcomeTest extends DuskTestCase
{
    /** @test */
    public function basic_test()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                ->waitFor('.mt-64', 1)
                ->assertSee(env('APP_NAME'));
        });
    }
}
