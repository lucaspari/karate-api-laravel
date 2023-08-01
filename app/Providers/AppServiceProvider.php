<?php

namespace App\Providers;

use App\Service\GolpeService;
use App\Service\KataService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GolpeService::class, function ($app) {
            return new GolpeService();
        });

        $this->app->bind(KataService::class,function ($app){
            return new KataService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
