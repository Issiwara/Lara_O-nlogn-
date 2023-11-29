<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// routes/web.php

// routes/web.php


Route::get('/', function () {
    $arraySize = 15000;

    // Generate a random array of 15,000 numbers
    $numbers = [];
    for ($i = 0; $i < $arraySize; $i++) {
        $numbers[] = rand(1, 100000);
    }

    // Measure the execution time
    $start_time = microtime(true);

    // Sort using quick sort
    quickSort($numbers, 0, $arraySize - 1);

    $end_time = microtime(true);
    $execution_time = ($end_time - $start_time);

    return view('welcome', compact('numbers', 'execution_time'));
});

function quickSort(&$arr, $low, $high)
{
    if ($low < $high) {
        // Partition the array, $pivotIndex is the index where $arr[$pivotIndex] is now at right place
        $pivotIndex = partition($arr, $low, $high);

        // Recursively sort elements before and after the pivot
        quickSort($arr, $low, $pivotIndex - 1);
        quickSort($arr, $pivotIndex + 1, $high);
    }
}

function partition(&$arr, $low, $high)
{
    $pivot = $arr[$high];
    $i = ($low - 1); // Index of smaller element

    for ($j = $low; $j <= $high - 1; $j++) {
        // If current element is smaller than or equal to pivot
        if ($arr[$j] <= $pivot) {
            $i++;

            // Swap $arr[$i] and $arr[$j]
            $temp = $arr[$i];
            $arr[$i] = $arr[$j];
            $arr[$j] = $temp;
        }
    }

    // Swap $arr[$i + 1] and $arr[$high] (or pivot)
    $temp = $arr[$i + 1];
    $arr[$i + 1] = $arr[$high];
    $arr[$high] = $temp;

    return ($i + 1);
}
