<?php

namespace App\Http\Controllers\Admin\RideManagement;

use App\Http\Controllers\Controller;

class ScheduledRideController extends Controller
{
    /**
     * Display scheduled rides.
     */
    public function index()
    {
        return view('admin.rides.scheduled.index');
    }
}
