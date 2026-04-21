<?php

namespace App\Http\Controllers\Api\Rider;

use App\Http\Controllers\Controller;
use App\Models\RecentSearch;
use App\Models\Rider;
use App\Models\SavedPlace;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RiderLocationController extends Controller
{
    /**
     * Constructor - ensure rider is authenticated
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // ═══════════════════════════════════════════════════════════════
    // SAVED PLACES APIs
    // ═══════════════════════════════════════════════════════════════

    /**
     * GET /api/rider/saved-places
     * Get all saved places for the authenticated rider
     */
    public function getSavedPlaces(): JsonResponse
    {
        $rider = auth()->user();

        $savedPlaces = SavedPlace::where('rider_id', $rider->id)
            ->ordered()
            ->get()
            ->groupBy('type');

        return response()->json([
            'status' => 'success',
            'data' => [
                'common' => $savedPlaces->get('home', collect())->merge($savedPlaces->get('work', collect()))->values(),
                'custom' => $savedPlaces->get('other', collect())->values(),
            ],
        ]);
    }

    /**
     * POST /api/rider/saved-places
     * Save a new place (Home, Work, or Custom)
     */
    public function savePlace(Request $request): JsonResponse
    {
        $rider = auth()->user();

        $validator = Validator::make($request->all(), [
            'type' => 'required|in:home,work,other',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'place_name' => 'nullable|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'is_default' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // If saving home/work, check if already exists (limit 1 each)
        if (in_array($request->type, ['home', 'work'])) {
            $existing = SavedPlace::where('rider_id', $rider->id)
                ->where('type', $request->type)
                ->first();

            if ($existing) {
                // Update existing
                $existing->update($request->except(['rider_id', 'type']));
                return response()->json([
                    'status' => 'success',
                    'message' => ucfirst($request->type) . ' location updated',
                    'data' => $existing->fresh(),
                ]);
            }
        }

        $place = SavedPlace::create([
            'rider_id' => $rider->id,
            ...$request->only([
                'type', 'name', 'address', 'place_name',
                'latitude', 'longitude', 'is_default'
            ]),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Place saved successfully',
            'data' => $place,
        ], 201);
    }

    /**
     * PUT /api/rider/saved-places/{id}
     * Update a saved place (for custom places)
     */
    public function updatePlace(Request $request, $id): JsonResponse
    {
        $rider = auth()->user();

        $place = SavedPlace::where('rider_id', $rider->id)
            ->where('id', $id)
            ->first();

        if (!$place) {
            return response()->json([
                'status' => 'error',
                'message' => 'Place not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:500',
            'place_name' => 'nullable|string|max:255',
            'latitude' => 'sometimes|numeric|between:-90,90',
            'longitude' => 'sometimes|numeric|between:-180,180',
            'is_default' => 'sometimes|boolean',
            'order_index' => 'sometimes|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $place->update($request->only([
            'name', 'address', 'place_name',
            'latitude', 'longitude', 'is_default', 'order_index'
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Place updated successfully',
            'data' => $place->fresh(),
        ]);
    }

    /**
     * DELETE /api/rider/saved-places/{id}
     * Delete a saved place
     */
    public function deletePlace($id): JsonResponse
    {
        $rider = auth()->user();

        $place = SavedPlace::where('rider_id', $rider->id)
            ->where('id', $id)
            ->first();

        if (!$place) {
            return response()->json([
                'status' => 'error',
                'message' => 'Place not found',
            ], 404);
        }

        $place->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Place deleted successfully',
        ]);
    }

    // ═══════════════════════════════════════════════════════════════
    // RECENT SEARCHES APIs
    // ═══════════════════════════════════════════════════════════════

    /**
     * GET /api/rider/recent-searches
     * Get recent search history
     */
    public function getRecentSearches(Request $request): JsonResponse
    {
        $rider = auth()->user();
        $limit = $request->input('limit', 10);
        $searchType = $request->input('search_type'); // destination, stop, pickup

        $query = RecentSearch::where('rider_id', $rider->id);

        if ($searchType) {
            $query->ofType($searchType);
        }

        $recentSearches = $query->recent($limit)->get();

        return response()->json([
            'status' => 'success',
            'data' => $recentSearches,
        ]);
    }

    /**
     * POST /api/rider/recent-searches
     * Save a recent search (auto-called when rider selects a location)
     */
    public function saveRecentSearch(Request $request): JsonResponse
    {
        $rider = auth()->user();

        $validator = Validator::make($request->all(), [
            'query_text' => 'required|string|max:255',
            'place_name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'full_address' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'place_id' => 'nullable|string|max:255',
            'search_type' => 'required|in:destination,stop,pickup',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Remove duplicate if same place searched before
        RecentSearch::where('rider_id', $rider->id)
            ->where('place_id', $request->place_id)
            ->orWhere(function ($q) use ($request, $rider) {
                $q->where('rider_id', $rider->id)
                  ->where('latitude', $request->latitude)
                  ->where('longitude', $request->longitude);
            })
            ->delete();

        $search = RecentSearch::create([
            'rider_id' => $rider->id,
            ...$request->only([
                'query_text', 'place_name', 'address', 'full_address',
                'latitude', 'longitude', 'place_id', 'search_type'
            ]),
            'searched_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Search saved',
            'data' => $search,
        ], 201);
    }

    /**
     * DELETE /api/rider/recent-searches/{id}
     * Delete a specific recent search
     */
    public function deleteRecentSearch($id): JsonResponse
    {
        $rider = auth()->user();

        $search = RecentSearch::where('rider_id', $rider->id)
            ->where('id', $id)
            ->first();

        if (!$search) {
            return response()->json([
                'status' => 'error',
                'message' => 'Search not found',
            ], 404);
        }

        $search->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Search removed',
        ]);
    }

    /**
     * DELETE /api/rider/recent-searches
     * Clear all recent searches
     */
    public function clearRecentSearches(): JsonResponse
    {
        $rider = auth()->user();

        RecentSearch::where('rider_id', $rider->id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Recent searches cleared',
        ]);
    }

    // ═══════════════════════════════════════════════════════════════
    // COMBINED DESTINATION SCREEN DATA
    // ═══════════════════════════════════════════════════════════════

    /**
     * GET /api/rider/destination-screen
     * Get all data for destination screen (saved places + recent searches)
     */
    public function getDestinationScreenData(): JsonResponse
    {
        $rider = auth()->user();

        // Get saved places grouped by type
        $savedPlaces = SavedPlace::where('rider_id', $rider->id)
            ->ordered()
            ->get()
            ->groupBy('type');

        // Get recent searches
        $recentSearches = RecentSearch::where('rider_id', $rider->id)
            ->recent(10)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'current_location' => [
                    'address' => 'Johar Town, Lahore', // You can fetch from rider's last known location
                    'latitude' => null,
                    'longitude' => null,
                ],
                'saved_places' => [
                    'home' => $savedPlaces->get('home', collect())->first(),
                    'work' => $savedPlaces->get('work', collect())->first(),
                    'others' => $savedPlaces->get('other', collect())->values(),
                ],
                'recent_searches' => $recentSearches,
                'max_stops_allowed' => 4,
            ],
        ]);
    }

    // ═══════════════════════════════════════════════════════════════
    // LOCATION SEARCH APIs
    // ═══════════════════════════════════════════════════════════════

    /**
     * GET /api/rider/search-locations
     * Search locations (integrate with Google Places API or similar)
     */
    public function searchLocations(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'query' => 'required|string|min:2',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'radius' => 'nullable|integer|min:1000|max:50000', // meters
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // TODO: Integrate with Google Places API / Mapbox / OpenStreetMap
        // For now, return mock data
        $mockResults = [
            [
                'place_id' => 'ChIJxxxxxxxxxx1',
                'name' => 'Liberty Market, Gulberg',
                'address' => 'Liberty Market, Gulberg III, Lahore',
                'full_address' => 'Liberty Market, Gulberg III, Lahore, Punjab, Pakistan',
                'latitude' => 31.5204,
                'longitude' => 74.3483,
                'types' => ['shopping_mall', 'point_of_interest'],
            ],
            [
                'place_id' => 'ChIJxxxxxxxxxx2',
                'name' => 'Packages Mall, Lahore',
                'address' => 'Packages Mall, Walton Road, Lahore',
                'full_address' => 'Packages Mall, Walton Road, Lahore, Punjab 54000, Pakistan',
                'latitude' => 31.4810,
                'longitude' => 74.3226,
                'types' => ['shopping_mall', 'point_of_interest'],
            ],
            [
                'place_id' => 'ChIJxxxxxxxxxx3',
                'name' => 'Mall Road, Lahore',
                'address' => 'Mall Road, Lahore',
                'full_address' => 'Mall Road, Lahore, Punjab, Pakistan',
                'latitude' => 31.5580,
                'longitude' => 74.3158,
                'types' => ['route', 'point_of_interest'],
            ],
        ];

        return response()->json([
            'status' => 'success',
            'data' => [
                'query' => $request->query,
                'results' => $mockResults,
            ],
        ]);
    }

    /**
     * GET /api/rider/place-details/{place_id}
     * Get detailed information about a place
     */
    public function getPlaceDetails($placeId): JsonResponse
    {
        // TODO: Integrate with Google Places API
        // For now, return mock data
        return response()->json([
            'status' => 'success',
            'data' => [
                'place_id' => $placeId,
                'name' => 'Sample Location',
                'address' => 'Sample Address, Lahore',
                'full_address' => 'Full sample address here',
                'latitude' => 31.5204,
                'longitude' => 74.3587,
                'phone' => '+92 300 1234567',
                'website' => 'https://example.com',
                'rating' => 4.5,
                'opening_hours' => [
                    'open_now' => true,
                    'weekday_text' => [
                        'Monday: 9:00 AM – 10:00 PM',
                        'Tuesday: 9:00 AM – 10:00 PM',
                    ],
                ],
            ],
        ]);
    }
}
