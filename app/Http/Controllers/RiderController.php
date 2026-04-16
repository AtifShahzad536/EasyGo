<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    /**
     * Display a listing of real riders.
     */
    public function index()
    {
        $riders = Rider::with('statistics')->latest()->paginate(15);
        return view('riders.index', compact('riders'));
    }

    public function updateStatus(Request $request, Rider $rider)
    {
        $request->validate([
            'status' => 'required|in:active,banned,inactive'
        ]);

        $rider->status = $request->status;
        $rider->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Rider status updated successfully',
            'rider' => $rider
        ]);
    }
}
