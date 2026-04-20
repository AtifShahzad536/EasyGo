<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarpoolRide extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'vehicle_id',
        'origin_address',
        'origin_lat',
        'origin_lng',
        'destination_address',
        'destination_lat',
        'destination_lng',
        'ride_date',
        'ride_time',
        'departure_timestamp',
        'available_seats',
        'fare_per_seat',
        'notes',
        'status',
    ];

    protected $casts = [
        'ride_date' => 'date',
        'ride_time' => 'datetime:H:i',
        'departure_timestamp' => 'datetime',
        'fare_per_seat' => 'decimal:2',
        'available_seats' => 'integer',
        'origin_lat' => 'decimal:8',
        'origin_lng' => 'decimal:8',
        'destination_lat' => 'decimal:8',
        'destination_lng' => 'decimal:8',
    ];

    /**
     * Get the driver that owns this carpool ride.
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    /**
     * Get the vehicle assigned to this carpool ride.
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Scope for active rides
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for driver's rides
     */
    public function scopeByDriver($query, $driverId)
    {
        return $query->where('driver_id', $driverId);
    }

    /**
     * Scope for rides from specific origin
     */
    public function scopeFromOrigin($query, $lat, $lng, $radiusKm = 10)
    {
        return $query->whereRaw(
            '(6371 * acos(cos(radians(?)) * cos(radians(origin_lat)) * cos(radians(origin_lng) - radians(?)) + sin(radians(?)) * sin(radians(origin_lat)))) <= ?',
            [$lat, $lng, $lat, $radiusKm]
        );
    }

    /**
     * Scope for rides to specific destination
     */
    public function scopeToDestination($query, $lat, $lng, $radiusKm = 10)
    {
        return $query->whereRaw(
            '(6371 * acos(cos(radians(?)) * cos(radians(destination_lat)) * cos(radians(destination_lng) - radians(?)) + sin(radians(?)) * sin(radians(destination_lat)))) <= ?',
            [$lat, $lng, $lat, $radiusKm]
        );
    }
}
