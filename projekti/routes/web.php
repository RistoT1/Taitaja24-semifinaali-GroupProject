<?php

use App\Http\Controllers\ThankyouController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TuotteetController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Middleware\TwoFactorMiddleware;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReseptitController;
use App\Http\Controllers\EmailChangeController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/test2', function () {
    return view('test2');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/tuotteet', [TuotteetController::class, 'index']);

Route::get('/kirjaudu', [AuthController::class, 'showLoginForm']);
Route::post('/kirjaudu', [AuthController::class, 'checkCredentials']);

Route::get('/rekisteroidy', function () {
    return view('rekisteroidy');
});
Route::post('/rekisteroidy', [AuthController::class, 'register']);

Route::get('/product', [TuotteetController::class, 'index'])->middleware(PreventBackHistory::class);
;
Route::get('/reseptit', [ReseptitController::class, 'index'])->middleware(PreventBackHistory::class);
;
Route::get('/', function () {
    return view('index');
})->middleware(PreventBackHistory::class)->name('index');
Route::get('/products', function () {
    return view('products');
})->middleware(PreventBackHistory::class);
Route::get('/about', function () {
    return view('about');
})->middleware(PreventBackHistory::class);
Route::get('/cart', [CartController::class, 'index'])->middleware(PreventBackHistory::class);
;
// Test login route
Route::get('/test-auth', function () {
    $user = \App\Models\User::find(21); // Use the user you just created
    if ($user) {
        Auth::login($user);
    }
    return [
        'auth_check' => Auth::check(),
        'auth_id' => Auth::id(),
        'user_email' => Auth::user() ? Auth::user()->Sähköposti : null,
    ];
});

/*
|--------------------------------------------------------------------------
| Protected Routes (Auth + PreventBackHistory)
|--------------------------------------------------------------------------
*/

// Profile page
Route::get('/me', function () {
    return view('profile', ['user' => Auth::user()]);
})->middleware(['auth', 'verified', PreventBackHistory::class])->name('me');

Route::post('/me/update', [AuthController::class, 'updateProfile'])
    ->middleware(['auth', 'verified', PreventBackHistory::class])->name('me.update');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/kirjaudu')->with('message', 'You have been logged out');
})->middleware(['auth', PreventBackHistory::class])->name('logout');

// Email verification pages
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth', PreventBackHistory::class])->name('verification.notice');

Route::get('/email/reset', function () {
    return view('auth.verify-email');
})->middleware(['auth', PreventBackHistory::class])->name('verification.notice');

Route::get('/email/verify/sent', function () {
    return view('auth.verification-sent');
})->middleware(['auth', PreventBackHistory::class])->name('verification.sent');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/me')->with('verified', true);
})->middleware(['auth', 'signed', PreventBackHistory::class])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1', PreventBackHistory::class])->name('verification.send');

// Two-factor authentication (unchanged)
Route::get('/2fa', function () {
    return view('auth.two-factor');
})->middleware(TwoFactorMiddleware::class)->name('two-factor');

Route::post('/2fa', [AuthController::class, 'verifyTwoFactor'])
    ->middleware(TwoFactorMiddleware::class);

Route::get('/email/change-request', [AuthController::class, 'sendEmailChange'])->middleware(['auth', PreventBackHistory::class])->name('email.change.request');

Route::get('/email/change/{token}', [EmailChangeController::class, 'showChangeForm'])
    ->name('email.change');

Route::post('/email/change', [EmailChangeController::class, 'updateEmail'])
    ->name('email.update');

// Cart (protected)
Route::post('/cart', [CartController::class, 'storeSession'])->middleware([PreventBackHistory::class]);
Route::post('/cart/remove-item', [CartController::class, 'remove'])->middleware([PreventBackHistory::class]);
Route::post('/cart/checkout', [CartController::class, 'store'])->middleware([PreventBackHistory::class]);
Route::post('/cart/update-item', [CartController::class, 'update'])->middleware([PreventBackHistory::class]);
Route::get('/thankyou', [ThankyouController::class, 'index'])->name('thankyou');
Route::get('/contacts', function () {
    return view('contact');
})->middleware(PreventBackHistory::class)->name('contacts');


Route::fallback(function () {
    return redirect()->route('index');
});
