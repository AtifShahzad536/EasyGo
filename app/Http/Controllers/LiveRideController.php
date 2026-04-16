<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiveRideController extends Controller
{
    public function index()
    {
        return view('live-rides.index');
    }
}
