<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 *
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param DatabaseManager $db
     *
     * @return void
     */
    public function boot(DatabaseManager $db)
    {
        if ($this->app->runningUnitTests()) {
            Schema::defaultStringLength(191);
        }

        // Enable on delete cascade for sqlite connections
        if ($db->connection() instanceof SQLiteConnection) {
            $db->statement($db->raw('PRAGMA foreign_keys = ON'));
        }

        $this->configureMacros();
        $this->addObservers();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing') && class_exists(DuskServiceProvider::class)) {
            $this->app->register(DuskServiceProvider::class);
        }
    }

    /**
     * @return void
     */
    public function addObservers()
    {
        User::observe(UserObserver::class);
    }

    /**
     * @return void
     */
    public function configureMacros()
    {
        $this->setUpCollectionMacros();
        $this->setUpResponseMacros();
    }

    /**
     * @return void
     */
    public function setUpCollectionMacros()
    {
        EloquentCollection::macro('update', function (array $attributes) {
            return $this->map(function ($model) use ($attributes) {
                if (is_subclass_of($model, Model::class)) {
                    $model->update($attributes);
                }
            });
        });

        // Delete all items or just the given ids.
        // Return remainders
        EloquentCollection::macro('delete', function ($ids = []) {
            if (is_subclass_of($ids, Model::class)) {
                $ids = $ids->getKey();
            }
            if ($ids instanceof EloquentCollection) {
                $ids = $ids->modelKeys();
            }
            if ($ids instanceof Collection) {
                $ids = $ids->toArray();
            }
            $ids = Arr::wrap($ids);
            return $this->filter(function ($model) use ($ids) {
                if (is_subclass_of($model, Model::class)) {
                    if (empty($ids)) {
                        $model->delete();
                        return false;
                    }
                    if (in_array($model->getKey(), $ids)) {
                        $model->delete();
                        return false;
                    }
                    return true;
                }
                return true;
            });
        });


        // Delete all items or just the given ids.
        // Return remainders
        EloquentCollection::macro('forceDelete', function ($ids = []) {
            if (is_subclass_of($ids, Model::class)) {
                $ids = $ids->getKey();
            }
            if ($ids instanceof EloquentCollection) {
                $ids = $ids->modelKeys();
            }
            if ($ids instanceof Collection) {
                $ids = $ids->toArray();
            }
            $ids = Arr::wrap($ids);
            return $this->filter(function ($model) use ($ids) {
                if (is_subclass_of($model, Model::class)) {
                    if (empty($ids)) {
                        $model->forceDelete();
                        return false;
                    }
                    if (in_array($model->getKey(), $ids)) {
                        $model->forceDelete();
                        return false;
                    }
                    return true;
                }
                return true;
            });
        });
    }

    /**
     * @return void
     */
    public function setUpResponseMacros()
    {
        $types = [
            'success',
            'info',
            'warning',
        ];
        $delay = 750;

        RedirectResponse::macro('error', function ($notification) use ($delay) {
            $status = [
                'title' => __('error_alert_title'),
                'body'  => __('error_alert_text'),
                'type'  => 'error',
                'delay' => $delay
            ];

            if (is_string($notification)) {
                $status['body'] = $notification;
            } else if (is_array($notification)) {
                // Pulling type so dev uses the function for better readability
                Arr::pull($notification, 'type');
                $status = array_merge($status, $notification);
            } else {
                throw new InvalidArgumentException('Unexpected value given.');
            }

            $this->with('notification', $status);

            return $this;
        });

        foreach ($types as $type) {
            RedirectResponse::macro($type, function ($notification) use ($type, $delay) {
                $status = [
                    'type'  => $type,
                    'delay' => $delay
                ];

                if (is_string($notification)) {
                    $status['body'] = $notification;
                } else if (is_array($notification)) {
                    // Pulling type so dev uses the function for better readability
                    Arr::pull($notification, 'type');
                    $status = array_merge($status, $notification);
                } else {
                    throw new InvalidArgumentException('Unexpected value given.');
                }

                $this->with('notification', $status);

                return $this;
            });
        }
    }
}
