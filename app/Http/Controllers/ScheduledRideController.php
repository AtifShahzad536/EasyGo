<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduledRideController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        return view('scheduled-rides.index', compact('status'));
    }
}
