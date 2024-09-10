<?php

namespace App\Providers;

use App\Models\Service;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        view()->composer('front_end.layouts.footer',function ($view){
            $view->with(['footerServices' => Service::orderBy('sort_order' , 'asc')->limit('5')->get(),'GeneralSettings' => Setting::find(1)]);
           });
    }
}
