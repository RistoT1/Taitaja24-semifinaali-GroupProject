<?php

namespace App\Http\Controllers;

use App\Models\PasswordChangeToken;
use App\Models\User;
use App\Notifications\PasswordResetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class PasswordController extends Controller
{
    // 1. Send reset link
    public function sendResetLink()
    {
        $user = Auth::user();

        $sähköposti = User::where('User_ID', $user->User_ID)->value('Sähköposti');
        log::info('Retrieved email for user ID ' . $user->User_ID . ': ' . $sähköposti);
        if (!$sähköposti) {
            return back()->withErrors(['email' => 'No user found with that email']);
        }


        $user->notify(new PasswordResetRequest($user));

        return back()->with('status', 'Password reset link sent!');
    }

    // 2. Show reset form
    public function showResetForm($token)
    {
        $tokenData = PasswordChangeToken::where('token', $token)->first();

        if (!$tokenData || $tokenData->expires_at < now()) {
            return redirect('/')->withErrors('This password reset link is invalid or expired.');
        }

        return view('auth.reset_password', [
            'token' => $token,
        ]);
    }

    // 3. Update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $tokenData = PasswordChangeToken::where('token', $request->token)->first();

        if (!$tokenData || $tokenData->expires_at < now()) {
            return back()->withErrors(['token' => 'Invalid or expired token.']);
        }

        $user = User::find($tokenData->user_id);
        $user->SalasanaHash = Hash::make($request->password);
        $user->save();

        // Delete token after use
        $tokenData->delete();

        return redirect('/kirjaudu')->with('status', 'Your password has been reset!');
    }
}
