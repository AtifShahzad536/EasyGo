<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');
        return view('payouts.index', compact('status'));
    }
}
