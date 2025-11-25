<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KirjauduController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        // If user is logged in (session or remember me), redirect
        if (Auth::check()) {
            return redirect()->route('me'); // guaranteed redirect to /me
        }
        return view('kirjaudu'); // Blade login page
    }

    // Handle login POST
    public function checkCredentials(Request $request)
    {
        $request->validate([
            'sähköposti' => 'required|email',
            'SalasanaHash' => 'required',
        ]);

        $credentials = [
            'Sähköposti' => $request->input('sähköposti'),
            'password' => $request->input('SalasanaHash'),
        ];

        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate(); // prevent session fixation
            return redirect()->intended('/me');
        }

        return back()->withErrors([
            'sähköposti' => 'The provided credentials do not match our records.',
        ]);
    }
}
