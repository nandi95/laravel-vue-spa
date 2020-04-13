<?php

namespace Tests\Unit\Macros;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class CollectionMacroTest
 * @package Tests\Unit
 */
class CollectionMacroTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function events_are_fired_for_deletion()
    {
        // Arrange
        Event::fake();
        $users = $this->refreshUsers();

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
        $users = $this->refreshUsers();

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
        // Arrange
        $users = $this->refreshUsers();

        // Assert
        $this->assertCount(2, $users->delete($users->first()->getKey()));

        // Arrange
        $users = $this->refreshUsers();

        // Assert
        $this->assertCount(1, $users->delete($users->take(2)));
    }

    /**
     * @test
     *
     * @return void
     */
    public function rows_are_force_deleted()
    {
        // Arrange
        $users = $this->refreshUsers();

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
        $users = $this->refreshUsers();

        // Assert
        $this->assertCount(2, $users->forceDelete(1));

        // Arrange
        $users = $this->refreshUsers();

        // Assert
        $this->assertCount(1, $users->forceDelete($users->take(2)));
    }


    /**
     * @test
     *
     * @return void
     */
    public function various_inputs_accepted()
    {
        // Accepts single id
        // Arrange
        $users = $this->refreshUsers();

        // Assert
        $this->assertCount(2, $users->forceDelete(1));

        // Accepts single model
        // Arrange
        $users = $this->refreshUsers();

        // Assert
        $this->assertCount(2, $users->forceDelete($users->first()));

        // Accepts a collection of ids
        // Arrange
        $users = $this->refreshUsers();

        // Assert
        $this->assertCount(1, $users->forceDelete($users->pluck('id')->take(2)));

        // Accepts an array of ids
        // Arrange
        $users = $this->refreshUsers();

        // Assert
        $this->assertCount(1, $users->forceDelete($users->pluck('id')->take(2)->toArray()));

        // Accepts a collection of models
        // Arrange
        $users = $this->refreshUsers();

        // Assert
        $this->assertCount(1, $users->forceDelete($users->take(2)));
    }



    /**
     * @test
     *
     * @return void
     */
    public function rows_are_updated()
    {
        // Arrange
        $users = $this->refreshUsers();

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
        $users = $this->refreshUsers();

        // Act
        $users->update(['first_name' => 'test']);

        // Assert
        Event::assertDispatched('eloquent.updated: ' . User::class, 3);
    }


    /**
     * Delete existing records and create new ones.
     *
     * @param int $count
     *
     * @return Collection
     */
    private function refreshUsers($count = 3)
    {
        User::query()->delete();
        return factory(User::class, $count)->create();
    }
}
