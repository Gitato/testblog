<?php
namespace App\Services\Calculator\Interfaces;

use App\Services\Calculator\Exceptions\CalculatorException;

interface OperationInterface
{
    /**
     * @param $firstOperand
     * @param $secondOperand
     * @throws CalculatorException
     * @return mixed
     */
    public function evaluate($firstOperand, $secondOperand);
}
