<?php


namespace Mout\Auth;


use Mout\Auth\App\Console\Commands\Install;
use Mout\Auth\App\Console\Commands\Reinstall;
use Mout\Auth\App\Console\Commands\Uninstall;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->commands([
            Install::class,
            Uninstall::class,
            Reinstall::class
        ]);
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/auth.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'laravel-auth');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'laravel-auth');
        $this->publishes([
            __DIR__ . '/App/Http/Controllers/Auth' => app_path('Http/Controllers/Auth'),
            __DIR__ . '/App/Http/Requests/Auth' => app_path('Http/Requests/Auth'),
            __DIR__ . '/App/Notifications/Auth' => app_path('Notifications/Auth'),
            __DIR__ . '/resources/views' => resource_path('views/vendor/laravel-auth'),
            __DIR__ . '/resources/lang' => resource_path('lang/vendor/laravel-auth'),
        ]);
    }
}
