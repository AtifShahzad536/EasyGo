<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Rider extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'full_name',
        'display_name',
        'mobile_number',
        'password',
        'email',
        'profile_photo',
        'session_token',
        'gender',
        'date_of_birth',
        'city',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'session_token',
    ];

    protected $casts = [
        'date_of_birth'   => 'date',
        'password'        => 'hashed',
    ];

    /**
     * Rider has one statistics record.
     */
    public function statistics()
    {
        return $this->hasOne(RiderStatistic::class);
    }

    /**
     * Get wallet balance through statistics relationship.
     */
    public function getWalletBalanceAttribute(): float
    {
        return $this->statistics?->wallet_balance ?? 0.00;
    }

    /**
     * Get total trips through statistics relationship.
     */
    public function getTotalTripsAttribute(): int
    {
        return $this->statistics?->total_trips ?? 0;
    }

    /**
     * Get average rating through statistics relationship.
     */
    public function getAverageRatingAttribute(): float
    {
        return $this->statistics?->average_rating ?? 0.00;
    }

    /**
     * Alias name for blade view consistency.
     */
    public function getNameAttribute(): string
    {
        return $this->full_name;
    }
}
