<?php
namespace App\Services;
use App\Services\Calculator\Interfaces\OperationInterface;

class Subtraction implements OperationInterface
{
    /**
     * @param $firstOperand
     * @param $secondOperand
     * @return mixed
     */
    public function evaluate($firstOperand, $secondOperand)
    {
        return $firstOperand - $secondOperand;
    }
}
