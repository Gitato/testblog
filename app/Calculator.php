<?php

namespace App;

use App\Repositories\Interfaces\OperationInterface;

class Calculator
{
//    public function index()
//    {
//        return view('kalculator');
//    }

//    public function kal(Request $request)
//    {
////        dd($request->operator);
//        $a=$request->a;
//        $b=$request->b;
//        $operator=$request->operator;
//        if ($operator=="+")
//        {
//            $a+=$b;
//        }
//        elseif ($operator=="-")
//        {
//            $a-=$b;
//        }
//        elseif ($operator=="*")
//        {
//            $a*=$b;
//        }
//        elseif ($operator=="/")
//        {
//            $a/=$b;
//        }
//        $output=$a+$b;
//        return view('kalculated')->withA($a)->withB($b)->withOutput($output);
//    }

    protected $variables=array();

    public function setVariables(array $variables=array())
    {
        $this->variables=$variables;
    }

    public function setOperation(OperationInterface $operation)
    {
        $this->operation=$operation;
    }

    public function result()
    {
        return  $this->operation->evaluate($this->variables);
    }

}
