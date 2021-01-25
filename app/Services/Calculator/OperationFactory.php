<?php


namespace App\Services\Calculator;


use App\Services\Calculator\Exceptions\UnknownOperationException;
use App\Services\Calculator\Operations\Addition;
use App\Services\Calculator\Interfaces\OperationFactoryInterface;
use App\Services\Calculator\Interfaces\OperationInterface;
use App\Services\Subtraction;

/**
 * Class OperationFactory
 * @package App\Services\Calculator
 */
class OperationFactory implements OperationFactoryInterface
{

    const MULTIPLICATION_OPERATION = 'multiplication';
    const DIVISION_OPERATION = 'division';
    const SUBTRACTION_OPERATION = 'subtraction';
    const ADDITION_OPERATION = 'addition';

    private function getDefinitions() : array
    {
        return [
            self::ADDITION_OPERATION => Addition::class,
            self::DIVISION_OPERATION => Division::class,
            self::SUBTRACTION_OPERATION => Subtraction::class,
            self::MULTIPLICATION_OPERATION => Multiplication::class,
        ];
    }

    /**
     * @param string $operation
     * @return OperationInterface
     * @throws UnknownOperationException
     */
    public function create(string $operation): OperationInterface
    {
            $definitions = $this->getDefinitions();

            $class = $definitions[$operation] ?? null;

            if (!$class) {
                throw new UnknownOperationException("Operation '". $operation . "' not found");
            }

            return app()->make($class);
    }
}
