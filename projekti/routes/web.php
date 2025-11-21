<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TuotteetController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test2', function () {
    return view('test2');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/tuotteet', [TuotteetController::class, 'index']);
