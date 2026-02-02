<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        \Illuminate\Database\Eloquent\Model::preventLazyLoading(!app()->isProduction());

        \Illuminate\Support\Facades\Event::listen(
            \App\Events\OrderPlaced::class,
            \App\Listeners\UpdateProductStock::class,
        );

        \Illuminate\Support\Facades\Event::listen(
            \App\Events\OrderPlaced::class,
            \App\Listeners\SendOrderConfirmationEmail::class,
        );

        \Illuminate\Support\Facades\Event::listen(
            [
                \Illuminate\Auth\Events\Login::class,
                \Illuminate\Auth\Events\Failed::class,
            ],
            \App\Listeners\LogSecurityAction::class
        );
    }
}
