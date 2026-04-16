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
        'from_city',
        'to_city',
        'ride_date',
        'ride_time',
        'available_seats',
        'fare_per_seat',
        'notes',
        'status',
    ];

    protected $casts = [
        'ride_date' => 'date',
        'ride_time' => 'datetime:H:i',
        'fare_per_seat' => 'decimal:2',
        'available_seats' => 'integer',
    ];

    /**
     * Get the driver that owns this carpool ride.
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
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
}
