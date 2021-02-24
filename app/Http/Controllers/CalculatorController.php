<?php

namespace App\Http\Controllers;

use App\Facades\CalculatorService;
use Illuminate\Http\Request;
use App\Services\Interfaces\OperationInterface;

class CalculatorController extends Controller
{
public function final()
{
    $calculator=new Calculator;
    $calculator->setVariables(8,2);
    $calculator->setOperation(new Multiply());
    echo $calculator->result();
}

}
