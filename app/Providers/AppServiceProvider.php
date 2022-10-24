<?php

namespace App\Providers;

use App\Models\Slider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        paginator::useBootstrap();

        $slider = Slider::orderBy('id', 'desc')->get();
        view()->share('global_slider', $slider);

    }
}
