<?php

namespace App\Http\Controllers;

use App\Models\Tuote;
use Illuminate\Http\Request;

class TuotteetController extends Controller
{
    //index hakee kaikki
    public function index(Request $request)
    {
        if ($request->has('id')) {
            $tuote = Tuote::find($request->id);

            if ($tuote) {
                return view('tuotteet', ['tuotteet' => collect([$tuote])]);
            } else {
                return view('tuotteet', [
                    'tuotteet' => collect([]),
                    'error' => 'Tuotetta ei löytynyt.'
                ]);
            }
        }

        $Tuotteet = Tuote::all();
        return view('tuotteet', ['tuotteet' => $Tuotteet]);
    }

    public function store(Request $request)
    {
                // Source - https://stackoverflow.com/a
        // Posted by Alexey Mezenin, modified by community. See post 'Timeline' for change history
        // Retrieved 2025-11-20, License - CC BY-SA 3.0
        $Tuote = Tuote::create($request->all());

        return response()->json(["success" => true, "message" => "Tuote lisätty onnistuneesti!", "Data" => $Tuote], 201);

    }

}