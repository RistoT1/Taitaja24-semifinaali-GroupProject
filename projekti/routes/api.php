<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TuotteetController;


Route::get('/tuotteet', [TuotteetController::class, 'apiIndex']);

Route::get('/categories', [CategoriesController::class, 'apiIndex']);


Route::post('/tuotteet', [TuotteetController::class, 'store']);

// routes/api.php
Route::get('/tilaukset', [] );
