<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        return view('promotions.index', compact('status'));
    }
}
