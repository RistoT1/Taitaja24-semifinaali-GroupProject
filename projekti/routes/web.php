<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TuotteetController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Middleware\TwoFactorMiddleware;
use App\Http\Controllers\CartController;

Route::get('/test2', function () {
    return view('test2');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/tuotteet', [TuotteetController::class, 'index']);

Route::get('/kirjaudu', [AuthController::class, 'showLoginForm']);

Route::get('/rekisteroidy', function () {
    return view('rekisteroidy');
});


Route::post('/rekisteroidy', [AuthController::class, 'register']);

Route::post('/kirjaudu', [AuthController::class, 'checkCredentials']);

Route::get('/me', function () {
    return view('profile', ['user' => Auth::user()]);
})->middleware(['auth', 'verified'])->name('me');

Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/kirjaudu')->with('message', 'You have been logged out');
})->middleware('auth')->name('logout');




Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/me')->with('verified', true);
})->middleware(['auth', 'signed'])->name('verification.verify');



Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/test-auth', function () {
    $user = \App\Models\User::find(21); // Use the user you just created
    
    if($user)
    {
            Auth::login($user);
    }

    return [
        'auth_check' => Auth::check(),
        'auth_id' => Auth::id(),
        'user_email' => Auth::user() ? Auth::user()->Sähköposti : null,
    ];
});

Route::get('/2fa', function () {
    return view('auth.two-factor');
})->middleware(TwoFactorMiddleware::class)->name('two-factor');

Route::post('/2fa', [AuthController::class, 'verifyTwoFactor'])
    ->middleware(TwoFactorMiddleware::class);

Route::get('/product', [TuotteetController::class, 'index']);

Route::post('/cart', [CartController::class, 'store']);

Route::get('/', function () {
    return view('index');
});