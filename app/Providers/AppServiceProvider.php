<?php

namespace App\Providers;

use App\Services\PostcardSendingService;
use Illuminate\Database\Schema\PostgresSchemaState;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Alias for PostcardSendingService used by Postcard Facade Class
        $this->app->singleton('Postcard', function ($app) {
            return new PostcardSendingService('us', 4, 6);
        });
    }
}
