<?php

namespace App\Http\Controllers;

use App\Models\Resepti;
use Illuminate\Http\Request;

class ReseptitController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->filled('Kategoria')) {
            return response()->json(["success" => false, "message" => "kategoria puuttuu"]);
        }

        $reseptit = Resepti::where('Kategoria', $request->Kategoria)->get()
            ->whenEmpty(fn() => Resepti::take(5)->get());

        return $reseptit->isEmpty()
            ? response()->json(["success" => false, "message" => "Reseptejä ei löydetty"])
            : response()->json(["success" => true, "data" => $reseptit]);
    }
}
