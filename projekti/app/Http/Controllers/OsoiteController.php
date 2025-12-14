<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Osoite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OsoiteController extends Controller
{
    public function update(Request $request)
    {
        Log::info('Raw request data:', $request->all());

        $validatedData = $request->validate([
            'Osoite' => 'nullable|string|max:255',
            'Postinumero' => [
                'nullable',
                'string',
                'regex:/^[0-9]{5}$/'
            ],
            'Kaupunki' => 'nullable|string|max:100'
        ], [
            // Custom error messages
            'Postinumero.regex' => 'Postinumero pitää olla täsmälleen 5 numeroa.'
        ]);

        

        Log::info('Validated data:', $validatedData);

        $user = Auth::user();

        // Create osoite if it doesn't exist
        if (!$user->Osoite_ID) {
            $osoite = new Osoite();
            $osoite->save();

            $user->Osoite_ID = $osoite->Osoite_ID;
            $user->save();

            Log::info('Created new Osoite with ID: ' . $osoite->Osoite_ID);
        } else {
            $osoite = Osoite::findOrFail($user->Osoite_ID);
            Log::info('Found existing Osoite with ID: ' . $user->Osoite_ID);
        }

        // Update fields
        foreach ($validatedData as $field => $value) {
            if (!empty($value)) {
                $osoite->$field = $value;
                Log::info("Updated field {$field} with value: {$value}");
            }
        }

        $osoite->save();

        Log::info('Osoite saved successfully');

        return response()->json([
            'success' => true,
            'message' => 'Osoite päivitetty onnistuneesti!',
            'data' => $validatedData
        ]);
    }
}