<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\Browser\Pages\Home;
use Tests\Browser\Pages\Register;
use Tests\DuskTestCase;

/**
 * Class RegisterTest
 *
 * @package Tests\Browser
 */
class RegisterTest extends DuskTestCase
{
    public function setUp(): void
    {
        parent::setup();

        static::closeAll();
    }

    /** @test */
    public function register_with_valid_data()
    {
        $this->browse(function ($browser) {
            $browser->visit(new Register)
                ->submit(factory(User::class)->state('toRegister')->make()->getAttributes())
                ->assertPageIs(Home::class);
        });
    }

    /** @test */
    public function can_not_register_with_the_same_twice()
    {
        $user = factory(User::class)->create();

        $this->browse(function ($browser) use ($user) {
            $browser->visit(new Register)
                ->submit(factory(User::class)->state('toRegister')->make(['email' => $user->email])->getAttributes())
                ->assertSee('The email has already been taken.');
        });
    }
}
