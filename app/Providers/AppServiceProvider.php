<?php

namespace App\Providers;

use App\Mixins\ResponseMixin;
use App\Services\PostcardSendingService;
use Illuminate\Database\Schema\PostgresSchemaState;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use App\Mixins\StrMixin;

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

        /****************************
         * Using Macroables for Str *
         ****************************/

        /**
         * Using mixin method for multiple macros
         * 
         * NOTE: Second Parameter is for argument replace
         * to prevent overwrite methods with the same name
         */
        Str::mixin(new StrMixin(), false);
        
        // Using macro method for one macro
        // Str::macro('partNumber', function ($part) {
        //     return 'AB-'. substr($part, 0, 3) .'-'. substr($part, 3);
        // });

        /*********************************
         * Using Macroables for Response *
         *********************************/
        
         /**
         * Using mixin method for multiple macros
         * 
         * NOTE: Second Parameter is for argument replace
         * to prevent overwrite methods with the same name
         */
        ResponseFactory::mixin(new ResponseMixin(), false);
        
        // Using macro method for one macro
        // ResponseFactory::macro('errorJson', function (
        //     string $message = "Default Error Message",
        //     int $code = 000
        // ) {
        //     return [
        //         'message' => $message,
        //         'code' => $code,
        //     ];
        // });
    }
}
