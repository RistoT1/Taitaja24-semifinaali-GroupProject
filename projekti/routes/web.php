<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TuotteetController;
use App\Http\Controllers\KirjauduController;
use Illuminate\Support\Facades\Auth;

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


Route::post('/kirjaudu', [KirjauduController::class, 'checkCredentials']);

Route::get('/kirjaudu', function () {
    return view('kirjaudu');
});

Route::get('/me', function () {
    $userID = Auth::id();
    $user = Auth::user();
    
    return response()->json(['id' => $userID, "user" => $user]);
})->middleware('auth');