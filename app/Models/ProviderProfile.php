<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProviderProfile extends Model
{
    protected $fillable = [
        'user_id',
        'nik',
        'phone',
        'expertise',
        'experience_years',
        'bio',
        'address',
        'city',
        'province',
        'postal_code',
        'primary_service_area',
        'rating',
        'rating_avg',
        'total_reviews',
        'completed_jobs',
        'total_jobs_done',
        'verification_status',
        'verified_at',
        'rejection_reason',
        'is_available',
        'avatar',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'verified_at'  => 'datetime',
        'rating'       => 'decimal:2',
        'rating_avg'   => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(ProviderDocument::class);
    }

    public function providerServices(): HasMany
    {
        return $this->hasMany(ProviderService::class);
    }

    public function areas(): HasMany
    {
        return $this->hasMany(ProviderArea::class);
    }

    public function isVerified(): bool
    {
        return $this->verification_status === 'verified';
    }

    public function isPending(): bool
    {
        return $this->verification_status === 'pending';
    }

    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : asset('images/default-avatar.png');
    }
}
