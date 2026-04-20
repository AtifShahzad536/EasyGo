<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    /**
     * Display all promotions.
     */
    public function index()
    {
        return view('admin.settings.promotions.index');
    }
}
