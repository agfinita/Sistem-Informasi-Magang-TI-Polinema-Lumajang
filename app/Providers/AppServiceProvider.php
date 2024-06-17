<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        // Pengambilan waktu terakhir login
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $lastActivity = Carbon::parse($user->last_activity);
                $timeAgo = $lastActivity->diffForHumans();
                $view->with('timeAgo', $timeAgo);
            }
        });
    }
}
