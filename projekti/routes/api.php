<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TuotteetController;


//uusi route pyyntö joka kallaa TuoteControllerin indexin
Route::get('/tuotteet', [TuotteetController::class, 'index']);

Route::post('/tuotteet', [TuotteetController::class,'store']);