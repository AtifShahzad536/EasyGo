<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RideHistoryController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        return view('ride-history.index', compact('status'));
    }
}
