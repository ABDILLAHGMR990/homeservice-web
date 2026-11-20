<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'invoice_number',
        'payment_method',
        'payment_channel',
        'amount',
        'platform_fee',
        'provider_earning',
        'payment_gateway',
        'status',
        'midtrans_order_id',
        'midtrans_transaction_id',
        'midtrans_snap_token',
        'midtrans_snap_url',
        'midtrans_payment_type',
        'midtrans_raw_response',
        'settled_at',
        'paid_at',
        'notes',
    ];

    protected $casts = [
        'amount'                => 'decimal:0',
        'platform_fee'          => 'decimal:0',
        'provider_earning'      => 'decimal:0',
        'paid_at'               => 'datetime',
        'settled_at'            => 'datetime',
        'midtrans_raw_response' => 'array',
    ];

    const STATUSES = [
        'pending'   => 'Menunggu Pembayaran',
        'paid'      => 'Lunas',
        'failed'    => 'Gagal',
        'refunded'  => 'Dikembalikan',
        'cash'      => 'Bayar Tunai',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function isPaid(): bool
    {
        return in_array($this->status, ['paid', 'cash', 'settlement']);
    }

    public function getStatusLabel(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }

    public function getFormattedAmountAttribute(): string
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function getFormattedEarningAttribute(): string
    {
        return 'Rp ' . number_format($this->provider_earning, 0, ',', '.');
    }
}
