<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DriverDocument extends Model
{
    protected $fillable = [
        'driver_id',
        'type',
        'file_path',
        'status',
        'rejection_reason',
    ];

    /**
     * Get the driver that owns the document.
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }
}

