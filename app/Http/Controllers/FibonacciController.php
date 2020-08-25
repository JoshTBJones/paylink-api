<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
     * @param string $term_number - All user input is passed as string
     */
    public function get_fibonacci_term ($term_number)
    {
        try
        {
            // validation
            if (!is_numeric($term_number))
            {
                throw new \Exception ("Input must be a number.", 400);
            }
            if ($term_number < 0)
            {
                throw new \Exception ("Index must be higher than 0.", 400);
            }

            $fibonacci = new Fibonacci();
            $fibonacci->get_term($term_number);
    
            // Return standardised JSON response
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
     * Get Fibonacci Term Index
     * 
     * @param int $fn_number Fibonacci number to be indexed
     */
    public function get_fibonacci_term_index ($fn_number)
    {
        try
        {
            // simple validation
            if (!is_numeric($fn_number))
            {
                throw new \Exception ("Input must be a number.", 400);
            }
            if ($fn_number > 12586269025)
            {
                throw new \Exception ("This demo can only index up to Fn 12586269025 (n=50) of the Fibonacci sequence.", 400);
            }

            $fibonacci = new Fibonacci();
            $fibonacci->get_term_number($fn_number);
    
            // Return standardised JSON response
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
