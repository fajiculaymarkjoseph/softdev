<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');  // Disable foreign key checks

        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
    
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }
    
}
