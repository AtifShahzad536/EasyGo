<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of all drivers.
     */
    public function index()
    {
        $drivers = Driver::with(['documents', 'vehicle', 'statistics'])
            ->latest()
            ->paginate(15);
        
        return view('admin.users.drivers.index', compact('drivers'));
    }

    /**
     * Show driver details.
     */
    public function show(Driver $driver)
    {
        $driver->load(['documents', 'vehicle', 'statistics']);
        return view('admin.users.drivers.show', compact('driver'));
    }

    /**
     * Update driver status.
     */
    public function updateStatus(Request $request, Driver $driver)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,suspended,banned'
        ]);

        $driver->status = $request->status;
        $driver->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Driver status updated successfully',
            'driver' => $driver
        ]);
    }

    /**
     * Update driver KYC status.
     */
    public function updateKycStatus(Request $request, Driver $driver)
    {
        $request->validate([
            'kyc_status' => 'required|in:pending,verified,rejected'
        ]);

        $driver->kyc_status = $request->kyc_status;
        $driver->save();

        return response()->json([
            'status' => 'success',
            'message' => 'KYC status updated successfully',
            'driver' => $driver
        ]);
    }
}
