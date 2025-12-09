<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThankyouController extends Controller
{
    public function index()
    {
        // Redirect if no order data
        if (!session()->has('order_data')) {
            return redirect()->route('index');
        }

        // Show thank you page
        return view('thankyou');
    }
}
