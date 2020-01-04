<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ViewServiceProvider
 *
 * @package App\Providers
 */
class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $user = auth()->user();
            $view->with('user', $user);
        });
    }
}
