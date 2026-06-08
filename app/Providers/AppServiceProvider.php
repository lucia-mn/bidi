<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Categoria;
use Illuminate\Support\Facades\URL;

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

        // forzar HTTPS en producción (Railway)
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        
        try {

            View::share(
                'categorias',
                Categoria::all()
            );

        } catch (\Exception $e) {

            // Evita errores durante migraciones o despliegues
            View::share('categorias', collect());

        }
    }
}