<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Service extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'base_price',
        'price_unit',
        'duration_estimate',
        'estimated_duration_minutes',
        'image',
        'image_path',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'base_price'        => 'decimal:0',
        'is_active'         => 'boolean',
        'duration_estimate' => 'integer',
        'sort_order'        => 'integer',
    ];

    const PRICE_UNITS = [
        'per_visit' => 'Per Kunjungan',
        'per_hour'  => 'Per Jam',
        'per_unit'  => 'Per Unit',
        'custom'    => 'Harga Negosiasi',
    ];

    // ─── Relationships ───────────────────────────────────────────────────────

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function providerServices(): HasMany
    {
        return $this->hasMany(ProviderService::class);
    }

    public function bookingItems(): HasMany
    {
        return $this->hasMany(BookingItem::class);
    }

    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(
            Review::class,
            BookingItem::class,
            'service_id', // Foreign key on booking_items table...
            'booking_id', // Foreign key on reviews table...
            'id',         // Local key on services table...
            'booking_id'  // Local key on booking_items table...
        );
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->base_price, 0, ',', '.');
    }

    public function getPriceUnitLabel(): string
    {
        return self::PRICE_UNITS[$this->price_unit] ?? $this->price_unit;
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&q=80';
    }
}
