<?php

namespace App\Http\Controllers;

use App\Models\Tuote;
use Illuminate\Http\Request;

class TuotteetController extends Controller
{
    // User-facing view
    public function index(Request $request)
    {

        //specific product page
        if ($request->filled('id')) {
            $tuotteet = Tuote::where('Tuote_ID', $request->id)->get();

            // If no product found, return a different view
            if ($tuotteet->isEmpty()) {
                return view('products'); // <-- your fallback view
            }

            return view('product', compact('tuotteet'));
        }

        $limit = 20;

        // No cursor → first page
        if (!$request->filled('cursor_created_at') || !$request->filled('cursor_id')) {

            $tuotteet = Tuote::orderBy('Lisätty', 'DESC')
                ->orderBy('Tuote_ID', 'DESC')
                ->limit($limit)
                ->get();

        } else {

            $cursorTime = $request->cursor_created_at;
            $cursorId = $request->cursor_id;

            $tuotteet = Tuote::where(function ($q) use ($cursorTime, $cursorId) {
                $q->where('Lisätty', '<', $cursorTime)
                    ->orWhere(function ($q2) use ($cursorTime, $cursorId) {
                        $q2->where('Lisätty', '=', $cursorTime)
                            ->where('Tuote_ID', '<', $cursorId);
                    });
            })
                ->orderBy('Lisätty', 'DESC')
                ->orderBy('Tuote_ID', 'DESC')
                ->limit($limit)
                ->get();
        }

        $last = $tuotteet->last();

        return response()->json([
            'data' => $tuotteet,
            'next_cursor' => $last ? [
                'cursor_created_at' => $last->Lisätty,
                'cursor_id' => $last->Tuote_ID
            ] : null
        ]);
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