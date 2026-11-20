<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProviderArea extends Model
{
    protected $fillable = [
        'provider_profile_id',
        'city',
        'district',
        'province',
        'radius_km',
    ];

    protected $casts = [
        'radius_km' => 'integer',
    ];

    public function providerProfile(): BelongsTo
    {
        return $this->belongsTo(ProviderProfile::class);
    }

    public function getFullAreaAttribute(): string
    {
        $parts = array_filter([$this->district, $this->city, $this->province]);
        return implode(', ', $parts);
    }
}
