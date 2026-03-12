<?php

use Illuminate\Support\Facades\Route;

// This tells Laravel: For any URL (where the path is anything or nothing), 
// just return the main welcome view that contains our <div id="app">
Route::get('/{any}', function () {
    return view('welcome'); 
})->where('any', '.*');
