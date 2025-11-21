<?php

namespace App\Http\Controllers;

use App\Models\Tuote;
use Illuminate\Http\Request;

class TuotteetController extends Controller
{
    //index hakee kaikki


    // User-facing view
    public function index(Request $request)
    {
        $tuotteet = $request->has('id')
            ? Tuote::where('id', $request->id)->get()
            : Tuote::all();

        return view('tuotteet', compact('tuotteet'));
    }

    // Admin-facing API
    public function apiIndex(Request $request)
    {
        // Base query
        $query = Tuote::query();

        // Filter by id if provided
        if ($request->has('id')) {
            $query->where('id', $request->id);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nimi', 'like', "%{$search}%");
        }
        if ($request->has('searchCategory')) {
            $searchCategory = $request->searchCategory;
            $query->where('Kategoria', 'like', "%{$searchCategory}%");
        }
        if ($request->has('searchOrder')) {
            switch ($request->searchOrder) {
                case 'created_at_asc':
                    $query->orderBy('Lisätty', 'asc'); // newest first
                    break;

                case 'created_at_desc':
                    $query->orderBy('Lisätty', 'desc'); // oldest first
                    break;

                case 'price_asc':
                    $query->orderBy('Hinta', 'asc'); // cheapest first
                    break;

                case 'price_desc':
                    $query->orderBy('Hinta', 'desc'); // most expensive first
                    break;
            }
        }


        // Fetch results
        $tuotteet = $query->get();

        // Counts
        $Activecount = Tuote::where('Tila', 1)->count();
        $Totalcount = Tuote::count();

        return response()->json([
            'data' => [
                'tuotteet' => $tuotteet,
                'ActiveCount' => $Activecount,
                'TotalCount' => $Totalcount,
            ]
        ]);
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