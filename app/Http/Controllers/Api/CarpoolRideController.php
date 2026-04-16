<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarpoolRide;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class CarpoolRideController extends Controller
{
    /**
     * Publish a new carpool ride
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function publishRide(Request $request): JsonResponse
    {
        try {
            $driver = $request->user();

            if (!$driver) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized. Please login first.',
                ], 401);
            }

            // Check if user is a Driver
            if (!$driver instanceof \App\Models\Driver) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized. Only drivers can publish rides.',
                ], 403);
            }

            $validator = Validator::make($request->all(), [
                'from_city' => 'required|string|max:255',
                'to_city' => 'required|string|max:255',
                'ride_date' => 'required|date|after_or_equal:today',
                'ride_time' => 'required|date_format:H:i',
                'available_seats' => 'required|integer|min:1|max:10',
                'fare_per_seat' => 'required|numeric|min:0|max:100000',
                'notes' => 'nullable|string|max:1000',
            ], [
                'from_city.required' => 'Please enter the starting city',
                'to_city.required' => 'Please enter the destination city',
                'ride_date.required' => 'Please select a ride date',
                'ride_date.after_or_equal' => 'Ride date must be today or in the future',
                'ride_time.required' => 'Please select a ride time',
                'available_seats.required' => 'Please specify available seats',
                'available_seats.min' => 'Minimum 1 seat required',
                'available_seats.max' => 'Maximum 10 seats allowed',
                'fare_per_seat.required' => 'Please specify fare per seat',
                'fare_per_seat.min' => 'Fare cannot be negative',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $ride = CarpoolRide::create([
                'driver_id' => $driver->id,
                'from_city' => $request->from_city,
                'to_city' => $request->to_city,
                'ride_date' => $request->ride_date,
                'ride_time' => $request->ride_time,
                'available_seats' => $request->available_seats,
                'fare_per_seat' => $request->fare_per_seat,
                'notes' => $request->notes,
                'status' => 'active',
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Carpool ride published successfully',
                'data' => [
                    'ride_id' => $ride->id,
                    'from_city' => $ride->from_city,
                    'to_city' => $ride->to_city,
                    'ride_date' => $ride->ride_date->format('Y-m-d'),
                    'ride_time' => $ride->ride_time->format('H:i'),
                    'available_seats' => $ride->available_seats,
                    'fare_per_seat' => $ride->fare_per_seat,
                    'notes' => $ride->notes,
                    'status' => $ride->status,
                    'created_at' => $ride->created_at->toDateTimeString(),
                ],
            ], 201);

        } catch (Throwable $e) {
            Log::error('Carpool ride publish error: ' . $e->getMessage(), [
                'driver_id' => $request->user()?->id,
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while publishing the ride. Please try again.',
            ], 500);
        }
    }

    /**
     * Get my published carpool rides
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function myRides(Request $request): JsonResponse
    {
        try {
            $driver = $request->user();

            if (!$driver) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized. Please login first.',
                ], 401);
            }

            // Check if user is a Driver
            if (!$driver instanceof \App\Models\Driver) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized. Only drivers can view their rides.',
                ], 403);
            }

            $rides = CarpoolRide::byDriver($driver->id)
                ->orderBy('ride_date', 'desc')
                ->orderBy('ride_time', 'desc')
                ->get();

            $formattedRides = $rides->map(function ($ride) {
                return [
                    'ride_id' => $ride->id,
                    'from_city' => $ride->from_city,
                    'to_city' => $ride->to_city,
                    'ride_date' => $ride->ride_date->format('d M Y'), // e.g., "10 Apr 2025"
                    'ride_time' => $ride->ride_time->format('h:i A'), // e.g., "08:30 AM"
                    'available_seats' => $ride->available_seats,
                    'fare_per_seat' => $ride->fare_per_seat,
                    'notes' => $ride->notes,
                    'status' => $ride->status,
                    'created_at' => $ride->created_at->toDateTimeString(),
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => [
                    'total_rides' => $rides->count(),
                    'rides' => $formattedRides,
                ],
            ], 200);

        } catch (Throwable $e) {
            Log::error('Get my rides error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while fetching rides.',
            ], 500);
        }
    }

    /**
     * Get all available carpool rides (for riders to search)
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function availableRides(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'from_city' => 'nullable|string|max:255',
                'to_city' => 'nullable|string|max:255',
                'ride_date' => 'nullable|date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $query = CarpoolRide::active()
                ->where('ride_date', '>=', now()->format('Y-m-d'));

            // Filter by from_city if provided
            if ($request->has('from_city')) {
                $query->where('from_city', 'like', '%' . $request->from_city . '%');
            }

            // Filter by to_city if provided
            if ($request->has('to_city')) {
                $query->where('to_city', 'like', '%' . $request->to_city . '%');
            }

            // Filter by date if provided
            if ($request->has('ride_date')) {
                $query->where('ride_date', $request->ride_date);
            }

            $rides = $query->with('driver:id,full_name,profile_photo')
                ->orderBy('ride_date', 'asc')
                ->orderBy('ride_time', 'asc')
                ->get();

            $formattedRides = $rides->map(function ($ride) {
                return [
                    'ride_id' => $ride->id,
                    'from_city' => $ride->from_city,
                    'to_city' => $ride->to_city,
                    'ride_date' => $ride->ride_date->format('d M Y'),
                    'ride_time' => $ride->ride_time->format('h:i A'),
                    'available_seats' => $ride->available_seats,
                    'fare_per_seat' => $ride->fare_per_seat,
                    'notes' => $ride->notes,
                    'driver' => [
                        'driver_id' => $ride->driver->id,
                        'full_name' => $ride->driver->full_name,
                        'profile_photo' => $ride->driver->profile_photo,
                    ],
                ];
            });

            return response()->json([
                'status' => 'success',
                'data' => [
                    'total_rides' => $rides->count(),
                    'rides' => $formattedRides,
                ],
            ], 200);

        } catch (Throwable $e) {
            Log::error('Get available rides error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while fetching available rides.',
            ], 500);
        }
    }

    /**
     * Cancel a carpool ride
     *
     * @param Request $request
     * @param int $rideId
     * @return JsonResponse
     */
    public function cancelRide(Request $request, $rideId): JsonResponse
    {
        try {
            $driver = $request->user();

            if (!$driver) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized. Please login first.',
                ], 401);
            }

            // Check if user is a Driver
            if (!$driver instanceof \App\Models\Driver) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized. Only drivers can cancel rides.',
                ], 403);
            }

            $ride = CarpoolRide::byDriver($driver->id)
                ->where('id', $rideId)
                ->first();

            if (!$ride) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ride not found or you do not have permission to cancel this ride.',
                ], 404);
            }

            if ($ride->status === 'cancelled') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ride is already cancelled.',
                ], 400);
            }

            $ride->status = 'cancelled';
            $ride->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Ride cancelled successfully',
                'data' => [
                    'ride_id' => $ride->id,
                    'status' => $ride->status,
                ],
            ], 200);

        } catch (Throwable $e) {
            Log::error('Cancel ride error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while cancelling the ride.',
            ], 500);
        }
    }

    /**
     * Edit/Update a carpool ride
     *
     * @param Request $request
     * @param int $rideId
     * @return JsonResponse
     */
    public function editRide(Request $request, $rideId): JsonResponse
    {
        try {
            $driver = $request->user();

            if (!$driver) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized. Please login first.',
                ], 401);
            }

            // Check if user is a Driver
            if (!$driver instanceof \App\Models\Driver) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized. Only drivers can edit rides.',
                ], 403);
            }

            $ride = CarpoolRide::byDriver($driver->id)
                ->where('id', $rideId)
                ->first();

            if (!$ride) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ride not found or you do not have permission to edit this ride.',
                ], 404);
            }

            if ($ride->status === 'cancelled') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cannot edit a cancelled ride.',
                ], 400);
            }

            $validator = Validator::make($request->all(), [
                'from_city' => 'sometimes|string|max:255',
                'to_city' => 'sometimes|string|max:255',
                'ride_date' => 'sometimes|date|after_or_equal:today',
                'ride_time' => 'sometimes|date_format:H:i',
                'available_seats' => 'sometimes|integer|min:1|max:10',
                'fare_per_seat' => 'sometimes|numeric|min:0|max:100000',
                'notes' => 'nullable|string|max:1000',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Update only provided fields
            if ($request->has('from_city')) $ride->from_city = $request->from_city;
            if ($request->has('to_city')) $ride->to_city = $request->to_city;
            if ($request->has('ride_date')) $ride->ride_date = $request->ride_date;
            if ($request->has('ride_time')) $ride->ride_time = $request->ride_time;
            if ($request->has('available_seats')) $ride->available_seats = $request->available_seats;
            if ($request->has('fare_per_seat')) $ride->fare_per_seat = $request->fare_per_seat;
            if ($request->has('notes')) $ride->notes = $request->notes;

            $ride->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Ride updated successfully',
                'data' => [
                    'ride_id' => $ride->id,
                    'from_city' => $ride->from_city,
                    'to_city' => $ride->to_city,
                    'ride_date' => $ride->ride_date->format('Y-m-d'),
                    'ride_time' => $ride->ride_time->format('H:i'),
                    'available_seats' => $ride->available_seats,
                    'fare_per_seat' => $ride->fare_per_seat,
                    'notes' => $ride->notes,
                    'status' => $ride->status,
                    'updated_at' => $ride->updated_at->toDateTimeString(),
                ],
            ], 200);

        } catch (Throwable $e) {
            Log::error('Edit ride error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the ride.',
            ], 500);
        }
    }

    /**
     * Delete a carpool ride permanently
     *
     * @param Request $request
     * @param int $rideId
     * @return JsonResponse
     */
    public function deleteRide(Request $request, $rideId): JsonResponse
    {
        try {
            $driver = $request->user();

            if (!$driver) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized. Please login first.',
                ], 401);
            }

            // Check if user is a Driver
            if (!$driver instanceof \App\Models\Driver) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized. Only drivers can delete rides.',
                ], 403);
            }

            $ride = CarpoolRide::byDriver($driver->id)
                ->where('id', $rideId)
                ->first();

            if (!$ride) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Ride not found or you do not have permission to delete this ride.',
                ], 404);
            }

            // Store ride info before deletion for response
            $deletedRideId = $ride->id;
            $ride->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Ride deleted permanently',
                'data' => [
                    'ride_id' => $deletedRideId,
                    'deleted' => true,
                ],
            ], 200);

        } catch (Throwable $e) {
            Log::error('Delete ride error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while deleting the ride.',
            ], 500);
        }
    }
}
