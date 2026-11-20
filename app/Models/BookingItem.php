<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingItem extends Model
{
    protected $fillable = [
        'booking_id',
        'service_id',
        'service_name',
        'service_name_snapshot',
        'unit_price',
        'service_price_snapshot',
        'quantity',
        'subtotal',
        'notes',
    ];

    protected $casts = [
        'unit_price'             => 'decimal:0',
        'service_price_snapshot' => 'decimal:0',
        'subtotal'               => 'decimal:0',
        'quantity'               => 'integer',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class)->withDefault([
            'name' => $this->service_name_snapshot ?? $this->service_name ?? 'Layanan',
        ]);
    }

    public function getFormattedPriceAttribute(): string
    {
        $price = $this->service_price_snapshot ?? $this->unit_price ?? 0;
        return 'Rp ' . number_format($price, 0, ',', '.');
    }

    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }
}
