<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecentSearch extends Model
{
    use HasFactory;

    protected $fillable = [
        'rider_id',
        'query_text',
        'place_name',
        'address',
        'full_address',
        'latitude',
        'longitude',
        'place_id',
        'search_type',
        'searched_at',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'searched_at' => 'datetime',
    ];

    public function rider(): BelongsTo
    {
        return $this->belongsTo(Rider::class);
    }

    // Scope for recent searches ordered by time
    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('searched_at', 'desc')->limit($limit);
    }

    // Scope for specific search type
    public function scopeOfType($query, string $type)
    {
        return $query->where('search_type', $type);
    }

    // Auto-update searched_at on create
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->searched_at)) {
                $model->searched_at = now();
            }
        });
    }
}
