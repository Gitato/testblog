<?php
namespace App;
use App\Repositories\Interfaces\OperationInterface;

class Summary implements OperationInterface
{
    public function evaluate(array $variables = array())
    {
        return array_sum($variables);   // TODO: Implement evaluate() method.
    }
}
