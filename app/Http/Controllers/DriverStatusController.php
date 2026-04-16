<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverStatusController extends Controller
{
    public function index()
    {
        $stats = [
            'online' => 4,
            'idle' => 2,
            'on_trip' => 2,
            'offline' => 2
        ];

        $drivers = [
            [
                'id' => 1,
                'name' => 'Ahmed Khan',
                'avatar' => 'AK',
                'vehicle' => 'Honda Civic',
                'city' => 'Karachi',
                'status' => 'On Trip', // Orange
                'last_active' => 'Active now',
                'trips' => 12,
                'earnings' => '3,850',
                'location' => 'Clifton',
                'lat' => 24.8138,
                'lng' => 67.0284
            ],
            [
                'id' => 2,
                'name' => 'Sara Ali',
                'avatar' => 'SA',
                'vehicle' => 'Toyota Corolla',
                'city' => 'Karachi',
                'status' => 'Online', // Green
                'last_active' => 'Active now',
                'trips' => 10,
                'earnings' => '3,200',
                'location' => 'DHA Phase 2',
                'lat' => 24.8340,
                'lng' => 67.0673
            ],
            [
                'id' => 3,
                'name' => 'Bilal Ahmed',
                'avatar' => 'BA',
                'vehicle' => 'Suzuki Alto',
                'city' => 'Lahore',
                'status' => 'Idle', // Blue
                'last_active' => 'Active now',
                'trips' => 8,
                'earnings' => '2,650',
                'location' => 'Gulberg',
                'lat' => 31.5204,
                'lng' => 74.3587
            ],
            [
                'id' => 4,
                'name' => 'Fatima Malik',
                'avatar' => 'FM',
                'vehicle' => 'Honda City',
                'city' => 'Karachi',
                'status' => 'Online',
                'last_active' => 'Active now',
                'trips' => 14,
                'earnings' => '4,320',
                'location' => 'Defence',
                'lat' => 24.8183,
                'lng' => 67.0583
            ],
            [
                'id' => 5,
                'name' => 'Usman Shah',
                'avatar' => 'US',
                'vehicle' => 'Toyota Yaris',
                'city' => 'Islamabad',
                'status' => 'Offline', // Gray
                'last_active' => '2 hours ago',
                'trips' => 6,
                'earnings' => '1,890',
                'location' => 'I-7',
                'lat' => 33.6844,
                'lng' => 73.0479
            ],
            [
                'id' => 6,
                'name' => 'Zain Abbas',
                'avatar' => 'ZA',
                'vehicle' => 'Honda Civic',
                'city' => 'Karachi',
                'status' => 'On Trip',
                'last_active' => 'Active now',
                'trips' => 11,
                'earnings' => '3,560',
                'location' => 'Saddar',
                'lat' => 24.8615,
                'lng' => 67.0099
            ],
            [
                'id' => 7,
                'name' => 'Mariam Khan',
                'avatar' => 'MK',
                'vehicle' => 'Suzuki Cultus',
                'city' => 'Lahore',
                'status' => 'Idle',
                'last_active' => 'Active now',
                'trips' => 9,
                'earnings' => '2,980',
                'location' => 'Johar Town',
                'lat' => 31.4697,
                'lng' => 74.2728
            ],
            [
                'id' => 8,
                'name' => 'Hasan Ali',
                'avatar' => 'HA',
                'vehicle' => 'Toyota Vitz',
                'city' => 'Karachi',
                'status' => 'Offline',
                'last_active' => '30 mins ago',
                'trips' => 7,
                'earnings' => '2,210',
                'location' => 'Malir',
                'lat' => 24.9080,
                'lng' => 67.1990
            ],
        ];

        return view('driver-status.index', compact('stats', 'drivers'));
    }
}
