<?php

namespace App\Http\Controllers\Api\Rider;

use App\Http\Controllers\Controller;
use App\Models\Rider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RiderProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Get rider profile (without display_name)
     */
    public function getProfile(Request $request): JsonResponse
    {
        $rider = $request->user();

        // Hide sensitive fields including display_name
        $profile = [
            'id' => $rider->id,
            'full_name' => $rider->full_name,
            'mobile_number' => $rider->mobile_number,
            'email' => $rider->email,
            'profile_photo' => $rider->profile_photo ? asset('storage/' . $rider->profile_photo) : null,
            'gender' => $rider->gender,
            'date_of_birth' => $rider->date_of_birth,
            'is_active' => $rider->is_active,
            'created_at' => $rider->created_at?->toDateTimeString(),
        ];

        return response()->json([
            'status' => 'success',
            'data' => $profile,
        ]);
    }

    /**
     * Update rider profile
     */
    public function updateProfile(Request $request): JsonResponse
    {
        $rider = $request->user();

        $validator = Validator::make($request->all(), [
            'full_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:riders,email,' . $rider->id,
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
            // Delete old photo
            if ($rider->profile_photo && Storage::disk('public')->exists($rider->profile_photo)) {
                Storage::disk('public')->delete($rider->profile_photo);
            }

            // Store new photo
            $path = $request->file('profile_photo')->store('profile_photos/riders', 'public');
            $rider->profile_photo = $path;
        }

        // Update other fields
        if ($request->has('full_name')) {
            $rider->full_name = $request->full_name;
        }
        if ($request->has('email')) {
            $rider->email = $request->email;
        }
        if ($request->has('gender')) {
            $rider->gender = $request->gender;
        }
        if ($request->has('date_of_birth')) {
            $rider->date_of_birth = $request->date_of_birth;
        }

        $rider->save();

        // Return updated profile (without display_name)
        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'data' => [
                'id' => $rider->id,
                'full_name' => $rider->full_name,
                'mobile_number' => $rider->mobile_number,
                'email' => $rider->email,
                'profile_photo' => $rider->profile_photo ? asset('storage/' . $rider->profile_photo) : null,
                'gender' => $rider->gender,
                'date_of_birth' => $rider->date_of_birth,
                'updated_at' => $rider->updated_at->toDateTimeString(),
            ],
        ]);
    }
}
