<?php

namespace bnjns\LaravelNotifications;

use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Config
        $this->publishes([
            __DIR__ . '/config/notifications.php' => config_path('notifications.php'),
        ], 'config');

        // Published views
        $this->loadViewsFrom(__DIR__ . 'resources/views', 'laravel-notifications');
        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/laravel-notifications'),
        ], 'views');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(NotificationHandler::class, function () {
            return new NotificationHandler($this->app['session.store']);
        });
        $this->app->alias(NotificationHandler::class, 'notify');
    }
}
