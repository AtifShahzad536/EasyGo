<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;

class PayoutController extends Controller
{
    /**
     * Display all payouts.
     */
    public function index()
    {
        return view('admin.finance.payouts.index');
    }
}
