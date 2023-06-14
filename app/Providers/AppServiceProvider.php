<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
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
         /* Configuración cuando se usa SSL y se usa un proxy inverso*/
         if($this->app->environment('production')) {
            \URL::forceScheme('https');
            \URL::forceRootUrl(Config::get('app.url'));
        }
    }
}
