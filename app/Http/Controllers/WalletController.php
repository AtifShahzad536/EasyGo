<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'rider');
        return view('wallets.index', compact('type'));
    }
}
