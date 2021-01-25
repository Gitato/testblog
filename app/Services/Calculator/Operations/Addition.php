<?php
namespace App\Services\Calculator\Operations;
use App\Services\Calculator\Interfaces\OperationInterface;

class Addition implements OperationInterface
{
    /**
     * @param $firstOperand
     * @param $secondOperand
     * @return mixed
     */
    public function evaluate($firstOperand, $secondOperand)
    {
        return $firstOperand + $secondOperand;
    }
}
