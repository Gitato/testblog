<?php
namespace App\Services\Calculator;
use App\Services\Calculator\Interfaces\OperationInterface;

class Multiplication implements OperationInterface
{
    /**
     * @param $firstOperand
     * @param $secondOperand
     * @return float|int
     */
    public function evaluate($firstOperand, $secondOperand)
    {
        return $firstOperand * $secondOperand;
    }
}

