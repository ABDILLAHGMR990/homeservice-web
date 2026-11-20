<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingStatusLog extends Model
{
    protected $fillable = [
        'booking_id',
        'from_status',
        'to_status',
        'changed_by',
        'notes',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    public function getStatusLabel(string $status): string
    {
        return match ($status) {
            'pending'     => 'Menunggu Konfirmasi',
            'accepted'    => 'Dikonfirmasi',
            'on_the_way'  => 'Teknisi Dalam Perjalanan',
            'in_progress' => 'Sedang Dikerjakan',
            'completed'   => 'Selesai',
            'cancelled'   => 'Dibatalkan',
            'rejected'    => 'Ditolak Teknisi',
            default       => ucfirst(str_replace('_', ' ', $status)),
        };
    }

    public function getFromStatusLabelAttribute(): string
    {
        return $this->getStatusLabel($this->from_status ?? '');
    }

    public function getToStatusLabelAttribute(): string
    {
        return $this->getStatusLabel($this->to_status);
    }
}
