<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix("fibonacci")->group(function () {
    Route::get("/{term_number}/term", "FibonacciController@get_fibonacci_term");
    Route::get("/{term_number}/index", "FibonacciController@get_fibonacci_term_index");
});

Route::prefix("fizzbuzz")->group(function () {
    Route::post("/", "FizzbuzzController@calculate_fizzbuzz");
});