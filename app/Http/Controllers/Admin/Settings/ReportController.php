<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Display all reports.
     */
    public function index()
    {
        return view('admin.settings.reports.index');
    }
}
