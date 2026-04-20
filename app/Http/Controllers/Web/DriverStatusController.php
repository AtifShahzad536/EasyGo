<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DriverStatusController extends Controller
{
    /**
     * Display driver status page.
     *
     * @return View
     */
    public function index(): View
    {
        $drivers = Driver::select('id', 'full_name', 'email', 'mobile_number', 'status', 'is_available', 'current_lat', 'current_lng')
            ->with('vehicle:id,driver_id,type')
            ->orderBy('full_name')
            ->get();

        $stats = [
            'total' => $drivers->count(),
            'online' => $drivers->where('is_available', true)->count(),
            'offline' => $drivers->where('is_available', false)->count(),
            'busy' => $drivers->where('status', 'busy')->count(),
        ];

        return view('admin.driver-status.index', compact('drivers', 'stats'));
    }
}
