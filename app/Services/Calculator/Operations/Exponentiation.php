<?php
namespace App\Services\Calculator\Operations;

use App\Services\Calculator\Interfaces\OperationInterface;

class Exponentiation implements OperationInterface
{
    /**
     * @param $firstOperand
     * @param $secondOperand
     * @return float|int
     */
    public function evaluate($firstOperand, $secondOperand)
    {

        return $firstOperand ** $secondOperand;
    }
}
