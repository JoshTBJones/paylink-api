<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Fizzbuzz;
use App\Http\Resources\FizzbuzzResource;


class FizzbuzzController extends Controller
{
    /**********************************************************************//**
     * Calculate Fizzbuzz
     * 
     * Calculates the Fizzbuzz results between a user submitted number range.
     * 
     * @param Request $request
     */
    public function calculate_fizzbuzz (Request $request)
    {
        try
        {
            // Validate user input
            $validator = Validator::make($request->all(), [
                "start" => "required|numeric|min:1",
                "end"   => "required|numeric|gt:start"
            ]);

            if ($validator->fails())
            {
                throw new \Exception ($validator->errors()->first(), 400);
            }

            // Sanitise user input
            $start   = (int) $request->input("start");
            $end     = (int) $request->input("end");
            $results = [];

            // Loop through user number range
            for ($i = $start; $i <= $end; $i+=1)
            {
                $result = "";

                if ($this->__is_divisible(3, $i))
                {
                    $result .= "Fizz";
                }

                if ($this->__is_divisible(5, $i))
                {
                    $result .= "Buzz";
                }

                if (!($this->__is_divisible(3, $i) || $this->__is_divisible(3, $i)))
                {
                    $result = $i;
                }

                $results[] = $result;
            }

            // Create new Fizzbuzz class 
            $fizzbuzz = new Fizzbuzz([
                "start"   => $start,
                "end"     => $end,
                "results" => $results
            ]);

            // Return standardised JSON response
            return new FizzbuzzResource($fizzbuzz);
        }
        catch (\Exception $e)
        {
            // custom API error handler
            // @see App\Helpers\ErrorResponseHelper.php
            return \ErrorResponseHelper::handle($e);
        }
    }

    /**********************************************************************//**
     * Is Divisible
     * 
     * @private
     * @param  int $divisor The number the dividend will be divided by
     * @param  int $dividend The number to be divided
     * @return boolean
     */
    private function __is_divisible(int $divisor, int $dividend)
    {
        if ($divisor === 0)
        {
            throw new \Exception ("You cannot divide by 0.", 400);
        }

        // If 0 (false) no remainder, so the number is divisible!
        if (!($dividend % $divisor))
        {
            return true;
        }

        return false;
    }
}
