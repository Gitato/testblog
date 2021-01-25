<?php

namespace App\Services\Calculator;

use App\Services\Calculator\Calculator;
use App\Services\Calculator\Interfaces\OperationFactoryInterface;
use App\Services\Calculator\OperationFactory;
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
        $this->app->bind(OperationFactoryInterface::class, OperationFactory::class);
        $this->app->bind('Calculator', Calculator::class);
    }

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
