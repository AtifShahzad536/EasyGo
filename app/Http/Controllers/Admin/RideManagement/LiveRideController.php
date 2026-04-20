<?php

namespace App\Http\Controllers\Admin\RideManagement;

use App\Http\Controllers\Controller;
use App\Models\Ride;

class LiveRideController extends Controller
{
    /**
     * Display all active/live rides.
     */
    public function index()
    {
        $rides = Ride::with(['rider', 'driver'])
            ->whereIn('status', ['searching', 'accepted', 'ongoing'])
            ->latest()
            ->paginate(20);
        
        return view('admin.rides.live.index', compact('rides'));
    }

    /**
     * Show live ride details with tracking.
     */
    public function show(Ride $ride)
    {
        $ride->load(['rider', 'driver', 'stops']);
        return view('admin.rides.live.show', compact('ride'));
    }
}
