<?php

namespace App\Providers;

use App\Services\ImgUploadService;
use Illuminate\Support\ServiceProvider;

class ImgUploadProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ImgUploadService::class,function($app){
            return new ImgUploadService();
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
