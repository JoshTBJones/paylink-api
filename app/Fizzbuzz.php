<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fizzbuzz extends Model
{
    /**********************************************************************//**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "start", "end", "results"
    ];

    /**********************************************************************//**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "results" => "array",
    ];
}
