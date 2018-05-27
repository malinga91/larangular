<?php

namespace App\Providers;

use App\Helper\FbPersistentDataHandler;
use Facebook\Facebook;
use Illuminate\Support\ServiceProvider;

class FacebookServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Facebook::class, function ($app) {
            return new Facebook([
                'app_id' => env('FACEBOOK_ID'),         // Your GitHub Client ID
                'app_secret' => env('FACEBOOK_SECRET'), // Your GitHub Client Secret
            ]);
        });
    }
}
