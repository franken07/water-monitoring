<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
public function boot(): void
{
    if (config('app.env') === 'production' || config('app.force_https')) {
        URL::forceScheme('https');
    }
}

    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }
    
}