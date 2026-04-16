<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DriverStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'wallet_balance',
        'total_earnings',
        'total_withdrawn',
        'average_rating',
        'total_trips',
        'completed_trips',
        'cancelled_trips',
        'cancellation_count',
        'total_online_minutes',
        'last_trip_at',
    ];

    protected $casts = [
        'wallet_balance' => 'decimal:2',
        'total_earnings' => 'decimal:2',
        'total_withdrawn' => 'decimal:2',
        'average_rating' => 'decimal:2',
        'total_trips' => 'integer',
        'completed_trips' => 'integer',
        'cancelled_trips' => 'integer',
        'cancellation_count' => 'integer',
        'total_online_minutes' => 'integer',
        'last_trip_at' => 'datetime',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }
}
