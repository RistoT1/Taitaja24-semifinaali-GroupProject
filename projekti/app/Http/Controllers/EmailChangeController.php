<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailChangeToken;
use App\Models\User;

class EmailChangeController extends Controller
{
    public function showChangeForm($token)
    {
        $tokenData = EmailChangeToken::where('token', $token)->firstOrFail();
        return view('auth.email_change', ['token' => $token]);
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'Sähköposti' => 'required|email|unique:users,Sähköposti',
        ]);

        $tokenData = EmailChangeToken::where('token', $request->token)->firstOrFail();
        $user = User::findOrFail($tokenData->user_id);
        $user->Sähköposti = $request->Sähköposti;
        $user->save();

        $tokenData->delete();

        return redirect('/')->with('status', 'Email changed successfully!');
    }
}
