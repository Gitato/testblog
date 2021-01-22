<?php

namespace App\Providers;

use App\Services\Multiply;
use Illuminate\Support\ServiceProvider;

class CalculatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCalculator();
//        $this->registerMultiply();
    }

    public function registerCalculator()
    {
        $this->app->bind('Calculator','App\Services\Calculator');
    }

//    public function registerMultiply()
//    {
//        $this->app->bind('Multiply', 'App\Services\Multiply');
//    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
