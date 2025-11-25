<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TuotteetController;
use App\Http\Controllers\KirjauduController;
use Illuminate\Support\Facades\Auth;

Route::get('/test2', function () {
    return view('test2');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/tuotteet', [TuotteetController::class, 'index']);

Route::get('/kirjaudu', [KirjauduController::class, 'showLoginForm']);

Route::post('/kirjaudu', [KirjauduController::class, 'checkCredentials']);

Route::get('/me', function () {

    return view('profile', ['user' => Auth::user()]);
})->middleware('auth')->name('me');

Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/kirjaudu')->with('message', 'You have been logged out');
})->middleware('auth')->name('logout');