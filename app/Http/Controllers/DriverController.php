<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of real drivers.
     */
    public function index()
    {
        $drivers = Driver::with(['documents', 'vehicle', 'statistics'])->latest()->paginate(15);
        return view('drivers.index', compact('drivers'));
    }
}
