<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TuotteetController;

Route::get('/categories', [CategoriesController::class, 'apiIndex']);


Route::post('/tuotteet', [TuotteetController::class, 'store']);

Route::get('/products', [TuotteetController::class, 'index']);



