<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'full_name',
        'mobile_number',
        'password',
        'email',
        'profile_photo',
        'cnic',
        'cnic_name',
        'date_of_birth',
        'gender',
        'session_token',
        'kyc_status',
        'status',
        'is_available',
        'current_lat',
        'current_lng',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'session_token',
    ];

    protected $casts = [
        'is_available'       => 'boolean',
        'current_lat'        => 'decimal:7',
        'current_lng'        => 'decimal:7',
        'password'           => 'hashed',
        'date_of_birth'      => 'date',
    ];

    /**
     * A driver has many document submissions.
     */
    public function documents()
    {
        return $this->hasMany(DriverDocument::class, 'driver_id');
    }

    /**
     * A driver has one vehicle.
     */
    public function vehicle()
    {
        return $this->hasOne(Vehicle::class);
    }

    /**
     * A driver has one statistics record.
     */
    public function statistics()
    {
        return $this->hasOne(DriverStatistic::class);
    }

    /**
     * Append a human-readable name alias for consistency with blade views.
     */
    public function getNameAttribute(): string
    {
        return $this->full_name;
    }

    /**
     * Get wallet balance through statistics relationship.
     */
    public function getWalletBalanceAttribute(): float
    {
        return $this->statistics?->wallet_balance ?? 0.00;
    }

    /**
     * Get total earnings through statistics relationship.
     */
    public function getTotalEarningsAttribute(): float
    {
        return $this->statistics?->total_earnings ?? 0.00;
    }

    /**
     * Get average rating through statistics relationship.
     */
    public function getAverageRatingAttribute(): float
    {
        return $this->statistics?->average_rating ?? 0.00;
    }

    /**
     * Get total trips through statistics relationship.
     */
    public function getTotalTripsAttribute(): int
    {
        return $this->statistics?->total_trips ?? 0;
    }
}
