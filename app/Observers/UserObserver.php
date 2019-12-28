<?php

namespace App\Observers;

use App\Models\User;

/**
 * Class UserObserver
 *
 * @package App\Observers
 */
class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param User $user
     *
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the User "updated" event.
     *
     * @param User $user
     *
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param User $user
     *
     * @return void
     */
    public function deleted(User $user)
    {
        $user->oauthProviders->delete();
    }

    /**
     * Handle the User "forceDeleted" event.
     *
     * @param User $user
     *
     * @return void
     */
    public function forceDeleted(User $user)
    {
        $user->oauthProviders->forceDelete();
    }
}
