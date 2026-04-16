<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Auth\Api\DriverDocumentController;
use App\Http\Controllers\Api\DriverStatisticController;
use App\Http\Controllers\Api\DriverStatusApiController;
use App\Http\Controllers\Api\UserLocationController;
use App\Http\Controllers\Api\CarpoolRideController;

/*
|--------------------------------------------------------------------------
| API Routes — Easygo
|--------------------------------------------------------------------------
| Auth is role-based: drivers use 'auth:driver' guard,
| riders use 'auth:rider' guard via Laravel Sanctum.
*/

// ─── Public Auth (no token required) ────────────────────────────────────────
Route::prefix('v1/auth')->group(function () {
    Route::post('/register', [ApiAuthController::class, 'register']);
    Route::post('/login',    [ApiAuthController::class, 'login']);

    // Phone number existence check (no auth required)
    Route::post('/check-driver-phone', [ApiAuthController::class, 'checkDriverPhone']);
    Route::post('/check-rider-phone', [ApiAuthController::class, 'checkRiderPhone']);
});

// ─── Driver Protected Routes ─────────────────────────────────────────────────
Route::middleware('auth:sanctum')->prefix('v1/driver')->group(function () {
    Route::get('/me', function (Request $request) {
        $user = $request->user();
        $userData = $user->toArray();
        if ($user->profile_photo) {
            $userData['profile_photo_url'] = asset('storage/' . $user->profile_photo);
        }
        return response()->json(['user' => $userData, 'role' => 'driver']);
    });
    // Step 3: Register vehicle details (requires auth)
    Route::post('/vehicle/register', [ApiAuthController::class, 'registerVehicle']);
    Route::post('/documents/upload', [DriverDocumentController::class, 'bulkUpload']);

    // ─── Driver Statistics API ──────────────────────────────────────────────
    Route::get('/statistics', [DriverStatisticController::class, 'getMyStatistics']);
    Route::get('/statistics/dashboard', [DriverStatisticController::class, 'getDashboardSummary']);
    Route::get('/statistics/trips', [DriverStatisticController::class, 'getTripStatistics']);
    Route::get('/statistics/earnings', [DriverStatisticController::class, 'getEarningsHistory']);
    Route::post('/statistics/update', [DriverStatisticController::class, 'updateStatistics']);

    // ─── Driver Status API ───────────────────────────────────────────────────
    Route::get('/status', [DriverStatusApiController::class, 'getStatus']);
    Route::post('/status/update', [DriverStatusApiController::class, 'updateStatus']);

    // ─── Driver Location API ─────────────────────────────────────────────────
    Route::get('/location', [UserLocationController::class, 'getLocation']);
    Route::post('/location/update', [UserLocationController::class, 'updateLocation']);

    // ─── Carpool Ride APIs ───────────────────────────────────────────────────
    Route::post('/carpool/publish', [CarpoolRideController::class, 'publishRide']);
    Route::get('/carpool/my-rides', [CarpoolRideController::class, 'myRides']);
    Route::post('/carpool/cancel/{rideId}', [CarpoolRideController::class, 'cancelRide']);
    Route::put('/carpool/edit/{rideId}', [CarpoolRideController::class, 'editRide']);
    Route::delete('/carpool/delete/{rideId}', [CarpoolRideController::class, 'deleteRide']);
});

// ─── Rider Protected Routes ───────────────────────────────────────────────────
Route::middleware('auth:sanctum')->prefix('v1/rider')->group(function () {
    Route::get('/me', function (Request $request) {
        $user = $request->user();
        $userData = $user->toArray();
        if ($user->profile_photo) {
            $userData['profile_photo_url'] = asset('storage/' . $user->profile_photo);
        }
        return response()->json(['user' => $userData, 'role' => 'rider']);
    });

    // ─── Rider Location API ──────────────────────────────────────────────────
    Route::get('/location', [UserLocationController::class, 'getLocation']);
    Route::post('/location/update', [UserLocationController::class, 'updateLocation']);

    // ─── Find Nearby Drivers (for rider to book ride) ────────────────────────
    Route::get('/drivers/nearby', [UserLocationController::class, 'findNearbyDrivers']);

    // ─── Search Available Carpool Rides ─────────────────────────────────────
    Route::get('/carpool/search', [CarpoolRideController::class, 'availableRides']);
});
