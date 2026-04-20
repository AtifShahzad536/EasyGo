<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    /**
     * Display wallet overview.
     */
    public function index()
    {
        return view('admin.finance.wallets.index');
    }
}
