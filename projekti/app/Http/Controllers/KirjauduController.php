<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KirjauduController extends Controller
{
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

        if (Auth::attempt($credentials, true)) { // Add 'true' for remember me
            $request->session()->regenerate();
            
            // Check if login actually worked
            if (Auth::check()) {
                return redirect('/me');
            }
        }

        return back()->withErrors([
            'sähköposti' => 'The provided credentials do not match our records.',
        ]);
    }
}