<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'role',
        'latitude',
        'longitude',
        'place_name',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * Get the user (driver or rider) associated with this location
     */
    public function user()
    {
        if ($this->role === 'driver') {
            return $this->belongsTo(Driver::class, 'user_id');
        }
        return $this->belongsTo(Rider::class, 'user_id');
    }

    /**
     * Scope to get locations by role
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Scope to get location by user ID and role
     */
    public function scopeByUser($query, $userId, $role)
    {
        return $query->where('user_id', $userId)->where('role', $role);
    }
}
