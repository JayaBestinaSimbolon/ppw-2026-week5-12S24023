<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        // Gunakan pagination Tailwind (kompatibel dengan desain SIPUS-Del)
        Paginator::useTailwind();

        // ----------------------------------------------------------------
        // SQL Audit — Mencatat setiap query ke storage/logs/laravel.log
        // Digunakan untuk membuktikan Eager Loading mencegah N+1 query.
        // ----------------------------------------------------------------
        if (config('app.debug')) {
            DB::listen(function ($query) {
                Log::channel('single')->info('[SQL AUDIT] ' . $query->sql, [
                    'bindings' => $query->bindings,
                    'time_ms'  => $query->time,
                ]);
            });
        }
    }
}
