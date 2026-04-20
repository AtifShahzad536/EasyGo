<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RideStop extends Model
{
    use HasFactory;

    protected $fillable = [
        'ride_id',
        'stop_order',
        'place_name',
        'address',
        'full_address',
        'latitude',
        'longitude',
        'place_id',
        'status',
        'reached_at',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'stop_order' => 'integer',
        'reached_at' => 'datetime',
    ];

    public function ride(): BelongsTo
    {
        return $this->belongsTo(CarpoolRide::class, 'ride_id');
    }

    // Scope for ordered stops
    public function scopeOrdered($query)
    {
        return $query->orderBy('stop_order');
    }

    // Scope for pending stops
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Mark as reached
    public function markAsReached(): void
    {
        $this->update([
            'status' => 'reached',
            'reached_at' => now(),
        ]);
    }
}
