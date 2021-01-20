<?php
namespace App;
use App\Repositories\Interfaces\OperationInterface;

class Segregation implements OperationInterface
{
    public function evaluate(array $variables = array())
    {
        $equals=array_shift($variables);
        foreach ($variables as $variable)
        {
            $result=$equals/$variable;
        }// TODO: Implement evaluate() method.
        return $result;
    }
}
