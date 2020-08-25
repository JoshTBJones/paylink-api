<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Fibonacci;
use App\Http\Resources\FibonacciResource;

class FibonacciController extends Controller
{
    /**********************************************************************//**
     * Get Fibonacci Term
     * 
     * The term is the sequence Fibonacci number for example the 10th number
     * returns the term 55.
     * 
     * @param int $term_number
     */
    public function get_fibonacci_term (int $term_number)
    {
        // validation
        if ($term_number < 0)
        {
            return response()->json([
                "error" => "Index must be higher than 0."
            ], 400);
        }

        try
        {
            $fibonacci = new Fibonacci();
            $fibonacci->get_term($term_number);
    
            return new FibonacciResource($fibonacci);
        }
        catch (\Exception $e)
        {
            // custom API error handler
            // @see App\Helpers\ErrorResponseHelper.php
            return \ErrorResponseHelper::handle($e);

        }
    }

    /**********************************************************************//**
     * Get Fibonacci Term Number
     * 
     * @param int $fn_number Fibonacci number to be indexed
     */
    public function get_fibonacci_number (int $fn_number)
    {
        // simple validation
        if ($fn_number > 100)
        {
            return response()->json([
                "error" => "This demo can only index the first 100 terms of the Fibonacci sequence."
            ], 400);
        }

        try
        {
            $fibonacci = new Fibonacci();
            $fibonacci->get_term_number($fn_number);
    
            return new FibonacciResource($fibonacci);
        }
        catch (\Exception $e)
        {
            // custom API error handler
            // @see App\Helpers\ErrorResponseHelper.php
            return \ErrorResponseHelper::handle($e);

        }
    }
}
