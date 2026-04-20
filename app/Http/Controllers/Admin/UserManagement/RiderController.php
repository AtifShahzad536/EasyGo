<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\Rider;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    /**
     * Display a listing of all riders.
     */
    public function index()
    {
        $riders = Rider::with('statistics')
            ->latest()
            ->paginate(15);
        
        return view('admin.users.riders.index', compact('riders'));
    }

    /**
     * Show rider details.
     */
    public function show(Rider $rider)
    {
        $rider->load('statistics');
        return view('admin.users.riders.show', compact('rider'));
    }

    /**
     * Update rider status.
     */
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
