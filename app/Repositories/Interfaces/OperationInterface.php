<?php
namespace App\Repositories\Interfaces;
interface OperationInterface
{
    public function evaluate(array $variables=array());
}
