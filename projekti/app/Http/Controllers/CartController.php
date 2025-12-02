<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $quantity = $request->input('quantity');
        $Tuote_ID = $request->input('TuoteID');

        // Get existing cart or start with empty array
        $cart = session()->get('cart', []);

        // Check if product already exists in cart
        $found = false;
        foreach ($cart as &$item) {
            if ($item['TuoteID'] == $Tuote_ID) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        // If not found, add new item
        if (!$found) {
            $cart[] = [
                'TuoteID' => $Tuote_ID,
                'quantity' => $quantity,
            ];
        }

        // Save updated cart back into session
        session()->put('cart', $cart);

        return response()->json([
            'data' => [
                'success' => true,
                'TuoteID' => $Tuote_ID,
                'quantity' => $quantity,
                'cart' => $cart, // optional: return full cart
            ]
        ]);
    }
}