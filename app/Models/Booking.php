<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    protected $fillable = [
        'booking_code',
        'customer_id',
        'provider_id',
        'address_id',
        'booking_date',
        'booking_time',
        'notes',
        'status',
        'payment_method',
        'payment_status',
        'subtotal',
        'platform_fee',
        'total_amount',
        'address_snapshot',
        'completed_at',
        'cancelled_at',
        'cancellation_reason',
    ];

    protected $casts = [
        'booking_date'      => 'date',
        'booking_time'      => 'datetime:H:i',
        'completed_at'      => 'datetime',
        'cancelled_at'      => 'datetime',
        'subtotal'          => 'decimal:0',
        'platform_fee'      => 'decimal:0',
        'total_amount'      => 'decimal:0',
        'address_snapshot'  => 'array',
    ];

    // ─── Status Constants ─────────────────────────────────────────────────────

    const STATUS_PENDING     = 'pending';
    const STATUS_ACCEPTED    = 'accepted';
    const STATUS_ON_THE_WAY  = 'on_the_way';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED   = 'completed';
    const STATUS_CANCELLED   = 'cancelled';
    const STATUS_REJECTED    = 'rejected';

    const STATUS_LABELS = [
        'pending'     => 'Menunggu Konfirmasi',
        'accepted'    => 'Dikonfirmasi',
        'on_the_way'  => 'Dalam Perjalanan',
        'in_progress' => 'Sedang Dikerjakan',
        'completed'   => 'Selesai',
        'cancelled'   => 'Dibatalkan',
        'rejected'    => 'Ditolak',
    ];

    const STATUS_COLORS = [
        'pending'     => 'warning',
        'accepted'    => 'primary',
        'on_the_way'  => 'info',
        'in_progress' => 'info',
        'completed'   => 'success',
        'cancelled'   => 'danger',
        'rejected'    => 'danger',
    ];

    // ─── Relationships ───────────────────────────────────────────────────────

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(BookingItem::class);
    }

    public function statusLogs(): HasMany
    {
        return $this->hasMany(BookingStatusLog::class)->orderBy('created_at');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    public function complaint(): HasOne
    {
        return $this->hasOne(Complaint::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class)->orderBy('created_at');
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? ucfirst($this->status);
    }

    public function getStatusColorAttribute(): string
    {
        return self::STATUS_COLORS[$this->status] ?? 'secondary';
    }

    public function isActive(): bool
    {
        return in_array($this->status, ['pending', 'accepted', 'on_the_way', 'in_progress']);
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isCancellable(): bool
    {
        return in_array($this->status, ['pending', 'accepted']);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    public function getBookingDateFormattedAttribute(): string
    {
        $days = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
                 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
        $months = ['January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret',
                   'April' => 'April', 'May' => 'Mei', 'June' => 'Juni', 'July' => 'Juli',
                   'August' => 'Agustus', 'September' => 'September', 'October' => 'Oktober',
                   'November' => 'November', 'December' => 'Desember'];

        $dayName   = $days[$this->booking_date->format('l')] ?? $this->booking_date->format('l');
        $monthName = $months[$this->booking_date->format('F')] ?? $this->booking_date->format('F');

        return $dayName . ', ' . $this->booking_date->format('d') . ' ' . $monthName . ' ' . $this->booking_date->format('Y');
    }

    // ─── Scopes ───────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'accepted', 'on_the_way', 'in_progress']);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeForCustomer($query, int $userId)
    {
        return $query->where('customer_id', $userId);
    }

    public function scopeForProvider($query, int $userId)
    {
        return $query->where('provider_id', $userId);
    }
}
