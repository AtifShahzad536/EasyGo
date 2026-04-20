<?php

namespace App\Http\Controllers\Api\Driver;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DriverProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Get driver profile
     */
    public function getProfile(Request $request): JsonResponse
    {
        $driver = $request->user();

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $driver->id,
                'full_name' => $driver->full_name,
                'mobile_number' => $driver->mobile_number,
                'email' => $driver->email,
                'profile_photo' => $driver->profile_photo ? asset('storage/' . $driver->profile_photo) : null,
                'cnic_number' => $driver->cnic_number,
                'date_of_birth' => $driver->date_of_birth,
                'gender' => $driver->gender,
                'status' => $driver->status,
                'kyc_status' => $driver->kyc_status,
                'current_balance' => $driver->current_balance,
                'total_earnings' => $driver->total_earnings,
                'created_at' => $driver->created_at?->toDateTimeString(),
            ],
        ]);
    }

    /**
     * Update driver profile
     */
    public function updateProfile(Request $request): JsonResponse
    {
        $driver = $request->user();

        $validator = Validator::make($request->all(), [
            'full_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:drivers,email,' . $driver->id,
            'gender' => 'sometimes|in:male,female,other',
            'date_of_birth' => 'sometimes|date|before:today',
            'profile_photo' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            if ($driver->profile_photo && Storage::disk('public')->exists($driver->profile_photo)) {
                Storage::disk('public')->delete($driver->profile_photo);
            }
            $path = $request->file('profile_photo')->store('profile_photos/drivers', 'public');
            $driver->profile_photo = $path;
        }

        // Update fields
        $fields = ['full_name', 'email', 'gender', 'date_of_birth'];
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $driver->$field = $request->$field;
            }
        }

        $driver->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'data' => [
                'id' => $driver->id,
                'full_name' => $driver->full_name,
                'mobile_number' => $driver->mobile_number,
                'email' => $driver->email,
                'profile_photo' => $driver->profile_photo ? asset('storage/' . $driver->profile_photo) : null,
                'updated_at' => $driver->updated_at->toDateTimeString(),
            ],
        ]);
    }
}
