<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $platformConfig = [
            'commission_rate' => 20,
            'cancellation_fee' => 50,
            'surge_Pricing_multiplier' => 1.5,
            'minimum_ride_fare' => 150,
        ];

        $fareManagement = [
            [
                'type' => 'Mini (Suzuki Alto, Cultus)',
                'base_fare' => 150,
                'per_km' => 25,
                'per_min' => 3
            ],
            [
                'type' => 'Standard (Honda City, Civic)',
                'base_fare' => 200,
                'per_km' => 35,
                'per_min' => 4
            ],
            [
                'type' => 'Premium (Toyota Corolla)',
                'base_fare' => 250,
                'per_km' => 45,
                'per_min' => 5
            ],
            [
                'type' => 'SUV (Honda BRV, Toyota Rush)',
                'base_fare' => 300,
                'per_km' => 55,
                'per_min' => 6
            ]
        ];

        $admins = [
            [
                'name' => 'Admin User',
                'email' => 'admin@platform.com',
                'role' => 'Super Admin',
                'last_login' => '2026-04-08 11:30 AM'
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah@platform.com',
                'role' => 'Moderator',
                'last_login' => '2026-04-08 09:15 AM'
            ],
            [
                'name' => 'Mike Chen',
                'email' => 'mike@platform.com',
                'role' => 'Support',
                'last_login' => '2026-04-07 05:45 AM'
            ]
        ];

        $appVersions = [
            'rider_version' => 'v2.4.1',
            'driver_version' => 'v2.4.0',
            'min_supported' => 'v2.0.0',
            'last_update' => '2026-03-15'
        ];

        return view('settings.index', compact('platformConfig', 'fareManagement', 'admins', 'appVersions'));
    }
}
