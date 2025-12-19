<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Incident;
use App\Observers\IncidentObserver;

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
    public function boot()
    {
        Incident::observe(IncidentObserver::class);
    }
}
