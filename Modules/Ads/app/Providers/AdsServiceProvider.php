<?php

namespace Modules\Ads\App\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Modules\Ads\App\Jobs\SendReminderMailToAdvertisers;

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
        $this->app->booted(function () {
            $schedule = app(Schedule::class);
            $schedule->job(SendReminderMailToAdvertisers::class)
                ->dailyAt('20:00');
        });
    }
}
