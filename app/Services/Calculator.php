<?php

namespace App\Services;

use App\Services\Interfaces\OperationInterface;

class Calculator
{

    protected $a;
    protected $b;

    public function setVariables($a,$b)
    {
        $this->a=$a;
        $this->b=$b;
    }

    public function setOperation(OperationInterface $operation)
    {
        $this->operation=$operation;
    }

    public function result()
    {
        return  $this->operation->evaluate($this->a,$this->b);
    }

}
