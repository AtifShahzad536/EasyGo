<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Display settings.
     */
    public function index()
    {
        $platformConfig = [
            'commission_rate' => 15,
            'cancellation_fee' => 50,
            'surge_Pricing_multiplier' => 1.5,
            'minimum_ride_fare' => 100,
        ];

        $fareManagement = [
            ['type' => 'Go Mini', 'base_fare' => 100, 'per_km' => 15, 'per_min' => 3],
            ['type' => 'Go Sedan', 'base_fare' => 150, 'per_km' => 20, 'per_min' => 4],
            ['type' => 'Go SUV', 'base_fare' => 250, 'per_km' => 30, 'per_min' => 5],
            ['type' => 'Go Luxury', 'base_fare' => 500, 'per_km' => 60, 'per_min' => 10],
        ];

        $admins = [
            ['name' => 'Super Admin', 'email' => 'admin@easygo.com', 'role' => 'Super Admin', 'last_login' => 'Just now'],
            ['name' => 'Support Manager', 'email' => 'support@easygo.com', 'role' => 'Support', 'last_login' => '2 hours ago'],
        ];

        $appVersions = [
            'rider_version' => 'v2.5.1',
            'driver_version' => 'v2.4.8',
            'min_supported' => 'v2.0.0',
        ];

        return view('settings.index', compact('platformConfig', 'fareManagement', 'admins', 'appVersions'));
    }
}
