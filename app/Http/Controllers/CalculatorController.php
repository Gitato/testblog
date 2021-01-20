<?php

namespace App\Http\Controllers;

use App\Calculator;
use App\Subtraction;
use App\Segregation;
use App\Summary;
use App\Multiply;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\OperationInterface;

class CalculatorController extends Controller
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

public function final()
{
    $calculator=new Calculator;
    $calculator->setVariables(array(6,2));
    $calculator->setOperation(new Subtraction());

    echo $calculator->result();
}

//    public function subtraction(Request $request)
//    {
//        $a=$request->a;
//        $b=$request->b;
//        $output=$a-$b;
//        $operator="-";
//        return view('calculator')->withA($a)->withB($b)->withOutput($output)->withOperator($operator);
//    }
//
//    public function multiplication(Request $request)
//    {
//        $a=$request->a;
//        $b=$request->b;
//        $output=$a*$b;
//        $operator="*";
//        return view('calculator')->withA($a)->withB($b)->withOutput($output)->withOperator($operator);
//    }
//
//    public function segmentation(Request $request)
//    {
//        $a=$request->a;
//        $b=$request->b;
//        $output=$a/$b;
//        $operator="/";
//        return view('calculator')->withA($a)->withB($b)->withOutput($output)->withOperator($operator);
//    }
}
