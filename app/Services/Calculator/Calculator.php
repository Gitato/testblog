<?php

namespace App\Services\Calculator;

use App\Services\Calculator\Interfaces\OperationFactoryInterface;
use App\Services\Interfaces\OperationInterface;

class Calculator
{
    /**
     * @var OperationFactoryInterface $operationFactory
     */
    protected $operationFactory;
    protected $firstOperand, $secondOperand;


    /**
     * @return Calculator
     */
    public static function instance() : Calculator
    {
        return app()->make(static::class);
    }

    /**
     * Calculator constructor.
     * @param OperationFactoryInterface $operationFactory
     */
    public function __construct(OperationFactoryInterface $operationFactory)
    {
        $this->operationFactory = $operationFactory;
    }

    /**
     * @param $firstOperand
     * @param $secondOperand
     */
    public function setOperands($firstOperand, $secondOperand) : Calculator
    {
        $this->firstOperand= $firstOperand;
        $this->secondOperand = $secondOperand;
        return $this;
    }


    /**
     * @param $operation
     * @return mixed
     * @throws Exceptions\CalculatorException
     */
    public function run($operation)
    {
        return $this
            ->operationFactory
            ->create($operation)
            ->evaluate($this->firstOperand, $this->secondOperand);
    }

}
