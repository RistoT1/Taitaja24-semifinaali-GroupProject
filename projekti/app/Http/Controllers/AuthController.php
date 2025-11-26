<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;


class AuthController extends Controller
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

            $request->session()->regenerate();

            $user = Auth::user(); // get the logged-in user

            // Generate 6-digit code
            $code = rand(100000, 999999);

            $user->two_factor_code = $code;
            $user->two_factor_expires_at = now()->addMinutes(10);
            $user->save();

            // Send email notification
            $user->notify(new \App\Notifications\TwoFactorCode($code));


            Auth::logout();

            // store user id for later validation
            session(['2fa:user_id' => $user->User_ID]);

            \Log::info('session on LOGIN', [
                'auth_check' => Auth::check(),
                'auth_id' => Auth::id(),
                '2fa_user_id' => session('2fa:user_id')
            ]);

            return redirect()->route('two-factor');
        }

        return back()->withErrors([
            'sähköposti' => 'Virheelliset tiedot',
        ]);
    }

    public function verifyTwoFactor(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric'
        ]);

        // Get user ID stored in session after login
        $userId = session('2fa:user_id');

        if (!$userId) {
            return redirect('/kirjaudu')->withErrors(['error' => 'Session expired. Please log in again.']);
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect('/kirjaudu')->withErrors(['error' => 'User not found.']);
        }

        // Check if code expired
        if ($user->two_factor_expires_at < now()) {
            return back()->withErrors(['code' => 'The code has expired.']);
        }

        // Check code match
        if ($request->code != $user->two_factor_code) {
            return back()->withErrors(['code' => 'Incorrect code.']);
        }

        // SUCCESS — clear code and log the user in
        $user->two_factor_code = null;
        $user->two_factor_expires_at = null;
        $user->save();

        // authenticate the user
        Auth::login($user);

        // Remove temp session
        session()->forget('2fa:user_id');

        return redirect('/me')->with('message', '2FA Successful!');
    }


    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'Nimi' => 'required|string|max:255',
            'Sähköposti' => 'required|email|unique:users,Sähköposti',
            'Puhelin' => 'nullable|string|max:20',
            'Salasana' => [
                'required',
                'min:8',
                'same:SalasanaConfirm',
                'regex:/[!@#$%^&*(),.?":{}|<>]/'
            ],
            'SalasanaConfirm' => 'required|min:8',
        ]);

        $user = User::create([
            'Nimi' => $validatedData['Nimi'],
            'Sähköposti' => $validatedData['Sähköposti'],
            'Puhelin' => $validatedData['Puhelin'] ?? null,
            'SalasanaHash' => Hash::make($validatedData['Salasana']),
        ]);

        \Log::info('BEFORE LOGIN', [
            'user_created' => $user->User_ID,
            'auth_check' => Auth::check()
        ]);

        Auth::login($user);

        \Log::info('AFTER LOGIN', [
            'auth_check' => Auth::check(),
            'auth_id' => Auth::id(),
            'session_id' => session()->getId()
        ]);

        $request->session()->regenerate();

        \Log::info('AFTER REGENERATE', [
            'auth_check' => Auth::check(),
            'session_id' => session()->getId()
        ]);

        event(new Registered($user));

        \Log::info('EVENT FIRED - Email should be sending', [
            'to' => $user->Sähköposti,
            'user_id' => $user->User_ID
        ]);

        return redirect()->route('verification.notice');
    }
}
