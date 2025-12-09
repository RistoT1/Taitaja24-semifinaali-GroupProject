<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tuote;
use App\Models\Tilausrivi;
use App\Models\Tilaus;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{

    public function index()
    {
        $cart = session()->get('cart', []);

        $Tuotteet = [];
        foreach ($cart as $item) {
            $tuote = Tuote::where('Tuote_ID', $item['TuoteID'])->first();
            if ($tuote) {
                $Tuotteet[] = [
                    'tuote' => $tuote,
                    'quantity' => $item['quantity'],
                ];
            }
        }

        return view('ostoskori', compact('Tuotteet', 'cart'));
    }
    public function storeSession(Request $request)
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
                'cartCount' => count($cart),
                'cart' => $cart, // optional: return full cart
            ]
        ]);
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        if (empty($cart)) {
            return response()->json([
                'data' => [
                    'success' => false,
                    'message' => 'Cart is empty'
                ]
            ], 400);
        }

        // Create new order
        $tilaus = new Tilaus();
        $tilaus->User_ID = $userId;
        $tilaus->TilausPvm = now();
        $tilaus->Tila = 'Tilattu'; // default status
        $tilaus->Kokonaishinta = 0; // calculate below
        $tilaus->save();

        $totalPrice = 0;

        // Create order rows
        foreach ($cart as $item) {
            $product = Tuote::find($item['TuoteID']);
            if (!$product) {
                continue;
            }

            $rowPrice = $product->Hinta * $item['quantity'];
            $totalPrice += $rowPrice;

            Tilausrivi::create([
                'Tilaus_ID' => $tilaus->Tilaus_ID,
                'Tuote_ID' => $item['TuoteID'],
                'Määrä' => $item['quantity'],
                'Hinta' => $product->Hinta,
            ]);
        }

        // Update total price
        $tilaus->Kokonaishinta = $totalPrice;
        $tilaus->save();

        // Clear cart after saving
        session()->forget('cart');

        session()->flash('order_data', [
            'order_id' => $tilaus->Tilaus_ID,
            'message' => 'Tilaus onnistui!'
        ]);
        return response()->json([
            'data' => [
                'redirect_url' => route('thankyou'),
            ]
        ]);
    }

    public function update(Request $request)
    {
        $Tuote_ID = $request->input('TuoteID');
        $quantity = $request->input('quantity');

        // Get existing cart or start with empty array
        $cart = session()->get('cart', []);

        // Update quantity for the specified product
        foreach ($cart as &$item) {
            if ($item['TuoteID'] == $Tuote_ID) {
                $item['quantity'] = $quantity;
                break;
            }
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

    public function remove(Request $request)
    {
        $Tuote_ID = $request->input('TuoteID');

        // Get existing cart or start with empty array
        $cart = session()->get('cart', []);
        // Filter out the item to be removed
        $cart = array_filter($cart, function ($item) use ($Tuote_ID) {
            return (string) $item['TuoteID'] !== (string) $Tuote_ID;
        });

        // Reindex array to maintain proper indices
        $cart = array_values($cart);

        Log::info('Cart after removal:', [$cart, $Tuote_ID]);

        // Save updated cart back into session
        session()->put('cart', $cart);

        return response()->json([
            'data' => [
                'success' => true,
                'TuoteID' => $Tuote_ID,
                'cart' => $cart, // optional: return full cart
            ]
        ]);
    }
}