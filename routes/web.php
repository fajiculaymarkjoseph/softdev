<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;


Route::get('/test-log', function () {
    Log::info('🔥 Laravel logging is working!');
    return 'Log message written!';
});


// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
