<?php
namespace App\Services\Calculator\Operations;
use App\Services\Calculator\Exceptions\DivisionByZeroException;
use App\Services\Calculator\Interfaces\OperationInterface;

class Division implements OperationInterface
{
    /**
     * @param $firstOperand
     * @param $secondOperand
     * @return float|int
     * @throws DivisionByZeroException
     */
    public function evaluate($firstOperand, $secondOperand)
    {
        if ($secondOperand == 0) {
            throw new DivisionByZeroException();
        }

        return $firstOperand / $secondOperand;
    }
}
