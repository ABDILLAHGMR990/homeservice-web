<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProviderService extends Model
{
    protected $fillable = [
        'provider_profile_id',
        'service_id',
        'custom_price',
        'custom_duration',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'is_active'       => 'boolean',
        'custom_price'    => 'decimal:0',
        'custom_duration' => 'integer',
    ];

    // ─── Relationships ───────────────────────────────────────────────────────

    public function providerProfile(): BelongsTo
    {
        return $this->belongsTo(ProviderProfile::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    /**
     * Returns effective price (custom if set, else service base_price).
     */
    public function getEffectivePriceAttribute(): float
    {
        return $this->custom_price ?? $this->service->base_price ?? 0;
    }

    public function getFormattedEffectivePriceAttribute(): string
    {
        return 'Rp ' . number_format($this->effective_price, 0, ',', '.');
    }
}
