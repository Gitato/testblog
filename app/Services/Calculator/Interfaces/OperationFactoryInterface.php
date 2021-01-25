<?php
namespace App\Services\Calculator\Interfaces;

interface OperationFactoryInterface
{
    /**
     * @param string $operation
     * @return OperationInterface
     */
    public function create(string $operation) : OperationInterface;
}
