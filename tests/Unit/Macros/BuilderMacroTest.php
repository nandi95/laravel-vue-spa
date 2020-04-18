<?php

namespace Tests\Unit\Macros;

use App\Models\User;
use Tests\TestCase;

class BuilderMacroTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function whereLike_constraint_works_with_string_column_name()
    {
        // Arrange
        factory(User::class, 3)->create();
        factory(User::class)->create(['first_name' => 'test']);

        // Act
        $users = User::query()->whereLike('first_name', 'es')->get();

        // Assert
        $this->assertCount(1, $users);
        $this->assertSame($users->first()->first_name, 'test');
    }


    /**
     * @test
     *
     * @return void
     */
    public function whereLike_constraint_works_with_array_of_column_names()
    {
        // Arrange
        factory(User::class, 3)->create();
        factory(User::class)->create(['first_name' => 'test']);

        // Act
        $users = User::query()->whereLike(['first_name', 'last_name'], 'es')->get();

        // Assert
        $this->assertCount(1, $users);
        $this->assertSame($users->first()->first_name, 'test');
    }
}
