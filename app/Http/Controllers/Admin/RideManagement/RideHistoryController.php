<?php

namespace App\Http\Controllers\Admin\RideManagement;

use App\Http\Controllers\Controller;
use App\Models\Ride;

class RideHistoryController extends Controller
{
    /**
     * Display completed and cancelled rides.
     */
    public function index()
    {
        $rides = Ride::with(['rider', 'driver'])
            ->whereIn('status', ['completed', 'cancelled'])
            ->latest()
            ->paginate(20);
        
        return view('admin.rides.history.index', compact('rides'));
    }

    /**
     * Show ride details.
     */
    public function show(Ride $ride)
    {
        $ride->load(['rider', 'driver', 'stops']);
        return view('admin.rides.history.show', compact('ride'));
    }
}
