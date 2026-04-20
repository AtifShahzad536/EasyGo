<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display all transactions.
     */
    public function index()
    {
        return view('admin.finance.transactions.index');
    }
}
