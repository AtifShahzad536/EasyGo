<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedPlace extends Model
{
    use HasFactory;

    protected $fillable = [
        'rider_id',
        'type',
        'name',
        'address',
        'place_name',
        'latitude',
        'longitude',
        'is_default',
        'order_index',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_default' => 'boolean',
    ];

    public function rider(): BelongsTo
    {
        return $this->belongsTo(Rider::class);
    }

    // Scope for common places (Home, Work)
    public function scopeCommon($query)
    {
        return $query->whereIn('type', ['home', 'work']);
    }

    // Scope for custom places
    public function scopeCustom($query)
    {
        return $query->where('type', 'other');
    }

    // Scope ordered
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index')->orderBy('created_at', 'desc');
    }
}
