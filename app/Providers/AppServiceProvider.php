<?php

namespace App\Providers;

use App\Models\customer;
use App\Models\order;
use App\Observers\CustomerObserver;
use App\Observers\OrderObserver;
use Carbon\Carbon;
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
        Carbon::setLocale('id');
        order::observe(OrderObserver::class);
    }
}
