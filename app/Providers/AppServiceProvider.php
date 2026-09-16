<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        // ✅ SET DEFAULT TIMEZONE UNTUK SELURUH APLIKASI
        date_default_timezone_set('Asia/Makassar');
        Carbon::setLocale('id');

        RateLimiter::for('booking', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('user_id') ?: $request->ip());
        });
    }
}