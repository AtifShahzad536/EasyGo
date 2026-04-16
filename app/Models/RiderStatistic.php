<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiderStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'rider_id',
        'wallet_balance',
        'total_spent',
        'total_refunded',
        'total_trips',
        'completed_trips',
        'cancelled_trips',
        'average_rating',
        'cancellation_count',
        'last_ride_at',
    ];

    protected $casts = [
        'wallet_balance' => 'decimal:2',
        'total_spent' => 'decimal:2',
        'total_refunded' => 'decimal:2',
        'average_rating' => 'decimal:2',
        'total_trips' => 'integer',
        'completed_trips' => 'integer',
        'cancelled_trips' => 'integer',
        'cancellation_count' => 'integer',
        'last_ride_at' => 'datetime',
    ];

    public function rider(): BelongsTo
    {
        return $this->belongsTo(Rider::class);
    }
}
