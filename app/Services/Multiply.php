<?php
namespace App\Services;
use App\Services\Interfaces\OperationInterface;

class Multiply implements OperationInterface
{
    public function evaluate($a,$b)
    {
        $result=$a*$b;
        // TODO: Implement evaluate() method.
        return $result;
    }
}

