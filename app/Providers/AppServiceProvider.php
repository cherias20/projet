<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Helpers\AuthHelper;

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
        // Définir les directives Blade personnalisées
        Blade::if('auth', function () {
            return AuthHelper::check();
        });

        Blade::if('guest', function () {
            return !AuthHelper::check();
        });
    }
}
