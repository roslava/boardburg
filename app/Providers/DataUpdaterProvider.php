<?php

namespace App\Providers;

use App\Services\DataUpdater\DataUpdaterService;
use Illuminate\Support\ServiceProvider;

class DataUpdaterProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DataUpdaterService::class,function($app){
            return new DataUpdaterService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
