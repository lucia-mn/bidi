<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Categoria;

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
    // elementos del subheader
    public function boot()
    {
        try {
            $categorias = Categoria::all();
            // lo que sea que hagas con $categorias
        } catch (\Exception $e) {
            // silenciar el error durante el build
        }
    }
}
