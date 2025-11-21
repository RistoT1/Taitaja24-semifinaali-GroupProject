<?php

namespace App\Http\Controllers;

use App\Models\Tuote;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function apiIndex(Request $request)
    {
        $categories = Tuote::select('Kategoria')
            ->distinct()
            ->pluck('Kategoria');

        return response()->json([
            'data' => $categories
        ]);
    }
}