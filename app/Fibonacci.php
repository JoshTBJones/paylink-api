<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fibonacci extends Model
{
    /**********************************************************************//**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "n", "xn", "sequence"
    ];

    /**********************************************************************//**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "sequence" => "array",
    ];

    /**********************************************************************//**
     * Gets the sequence index from the supplied term
     * 
     * @param int $n the Fibonacci number to index
     */
    public function get_term (int $n)
    {
        // fibonacci sequence
        $fn_sequence = [];
        // previous fibonacci number
        $fn_previous = 0;
        // current fibonacci number
        $fn_current  = 0;
        
        // loop from 0 to index to build fibonacci sequence
        for ( $i = 0; $i <= $n; $i+=1 )
        {
            $fn_new      = $fn_previous + $fn_current;
            $fn_previous = $fn_current;
            $fn_current  = $fn_new;

            // If current fibonacci number is zero, add 1 to previous to start
            // incrementing on next step.
            if ($fn_new === 0)
            {
                $fn_previous += 1;
            }

            $fn_sequence[] = $fn_current;
        }

        $this->n        = $n;
        $this->xn       = $fn_current;
        $this->sequence = $fn_sequence;

        return;
    }

    /**********************************************************************//**
     * Get the term number
     * 
     * Basically the inverse of the above function. Instead of getting the term
     * from the fibonacci sequence instead we get the index or term number from
     * the supplied sequence number.
     */
    public function get_term_number (int $xn)
    {
        // validation
        if ($xn > 100)
        {
            throw new \Exception ("This demo can only index the first 100 terms of the Fibonacci sequence.");
        }

        // fibonacci sequence
        $fn_sequence = [];
        // previous fibonacci number
        $fn_previous = 0;
        // current fibonacci number
        $fn_current  = 0;
        // current term number
        $fn_term;

        for ( $fn_term = 0; $fn_term <= 100; $fn_term+=1 )
        {
            $fn_new      = $fn_previous + $fn_current;
            $fn_previous = $fn_current;
            $fn_current  = $fn_new;

            // If current fibonacci number is zero, add 1 to previous to start
            // incrementing on next step.
            if ($fn_new === 0)
            {
                $fn_previous += 1;
            }

            $fn_sequence[] = $fn_current;

            // If passed fn matches current fn function complete
            if ($xn === $fn_current)
            {
                break;
            }

            // If fn current is greater than the passed term we know the number
            // does not appear in the Fibonacci sequence.
            if ($xn < $fn_current)
            {
                throw new \Exception ("The term " . $xn . " does not exist in the Fibonacci sequence.");
            }
        }

        $this->n        = $fn_term;
        $this->xn       = $fn_current;
        $this->sequence = $fn_sequence;

        return;
    }
}
