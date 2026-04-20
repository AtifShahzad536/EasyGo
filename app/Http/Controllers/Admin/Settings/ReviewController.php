<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    /**
     * Display all reviews.
     */
    public function index()
    {
        return view('admin.settings.reviews.index');
    }
}
