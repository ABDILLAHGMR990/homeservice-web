<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'booking_id',
        'customer_id',
        'provider_id',
        'rating',
        'comment',
        'provider_reply',
        'provider_replied_at',
        'is_published',
    ];

    protected $casts = [
        'rating'              => 'integer',
        'is_published'        => 'boolean',
        'provider_replied_at' => 'datetime',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function getRatingLabelAttribute(): string
    {
        return match ($this->rating) {
            5 => 'Sangat Puas',
            4 => 'Puas',
            3 => 'Cukup',
            2 => 'Kurang',
            1 => 'Sangat Kurang',
            default => '-',
        };
    }
}
