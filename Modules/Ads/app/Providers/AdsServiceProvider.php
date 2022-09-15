<?php

namespace Modules\Ads\App\Providers;

use Illuminate\Support\ServiceProvider;

class AdsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/ads.php', 'Ads');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->app->register(AdsRouteServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
