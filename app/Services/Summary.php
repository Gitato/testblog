<?php
namespace App\Services;
use App\Services\Interfaces\OperationInterface;

class Summary implements OperationInterface
{
    public function evaluate($a,$b)
    {
        $result=$a+$b;
        return $result;   // TODO: Implement evaluate() method.
    }
}
