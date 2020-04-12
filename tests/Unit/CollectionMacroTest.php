<?php

namespace Tests\Unit;

use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class CollectionMacroTest
 * @package Tests\Unit
 */
class CollectionMacroTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function events_are_fired_for_deletion()
    {
        // Arrange
        Event::fake();
        $users = factory(User::class, 3)->create();

        // Act
        $users->delete();

        // Assert
        Event::assertDispatched('eloquent.deleted: ' . User::class, 3);
    }

    /**
     * @test
     *
     * @return void
     */
    public function rows_are_deleted()
    {
        // Arrange
        $users = factory(User::class, 3)->create();

        // Act
        $users->delete();

        // Assert
        $this->assertEquals(0, User::count());
        $this->assertEquals(3, User::onlyTrashed()->count());
    }

    /**
     * @test
     *
     * @return void
     *
     * @throws Exception
     */
    public function if_ids_given_only_specified_models_are_deleted()
    {
        $this->withoutExceptionHandling();
        // Arrange
        $users = factory(User::class, 3)->create();

        // Assert
        $this->assertCount(2, $users->delete($users->first()->getKey()));

        // Arrange
        User::query()->delete();
        $users = factory(User::class, 3)->create();

        // Assert
        $this->assertCount(1, $users->delete($users->pluck('id')->take(2)));
    }

    /**
     * @test
     *
     * @return void
     */
    public function rows_are_force_deleted()
    {
        // Arrange
        $users = factory(User::class, 3)->create();

        // Act
        $users->forceDelete();

        // Assert
        $this->assertEquals(0, User::withTrashed()->count());
    }


    /**
     * @test
     *
     * @return void
     */
    public function if_ids_given_only_specified_models_are_force_deleted()
    {
        // Arrange
        $users = factory(User::class, 3)->create();

        // Assert
        $this->assertCount(2, $users->forceDelete(1));

        // Arrange
        User::query()->delete();
        $users = factory(User::class, 3)->create();

        // Assert
        $this->assertCount(1, $users->forceDelete($users->pluck('id')->take(2)->toArray()));
    }



    /**
     * @test
     *
     * @return void
     */
    public function rows_are_updated()
    {
        // Arrange
        $users = factory(User::class, 3)->create();

        // Act
        $users->update(['first_name' => 'test']);

        // Assert
        $this->assertEquals(3, User::where('first_name', 'test')->count());
    }


    /**
     * @test
     *
     * @return void
     */
    public function events_are_fired_for_update()
    {
        // Arrange
        Event::fake();
        $users = factory(User::class, 3)->create();

        // Act
        $users->update(['first_name' => 'test']);

        // Assert
        Event::assertDispatched('eloquent.updated: ' . User::class, 3);
    }
}
