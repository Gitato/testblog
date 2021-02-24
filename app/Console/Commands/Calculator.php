<?php

namespace App\Console\Commands;

use App\Facades\CalculatorService;
use Illuminate\Console\Command;

class Calculator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        return \App\Services\Calculator\Calculator::instance();
        CalculatorService::setOperands(4,-5);
        echo CalculatorService::run('exponentiation');
    }
}

