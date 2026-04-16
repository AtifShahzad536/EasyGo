<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'make',
        'model',
        'color',
        'plate_number',
        'type',
        'year',
        'is_active',
        'verified_at',
    ];

    protected $casts = [
        'year' => 'integer',
        'is_active' => 'boolean',
        'verified_at' => 'datetime',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }
}
