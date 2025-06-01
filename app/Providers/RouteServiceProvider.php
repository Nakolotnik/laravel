<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        // Закомментируйте или удалите эту строку, если используете Laravel 11+
        // Route::middleware('web')
        //     ->group(base_path('routes/web.php'));
    }
}