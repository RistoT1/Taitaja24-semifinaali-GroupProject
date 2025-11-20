<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TuotteetController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test2', function () {
    return view('test2');
});

