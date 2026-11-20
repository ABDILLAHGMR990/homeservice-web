<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Complaint extends Model
{
    protected $fillable = [
        'booking_id',
        'customer_id',
        'ticket_number',
        'issue_category',
        'subject',
        'description',
        'evidence_path',
        'status',
        'priority',
        'admin_notes',
        'resolution_notes',
        'resolved_at',
        'resolved_by',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    const STATUSES = [
        'open'          => 'Dibuka',
        'in_review'     => 'Sedang Ditinjau',
        'investigating' => 'Sedang Diinvestigasi',
        'waiting_info'  => 'Menunggu Info',
        'resolved'      => 'Diselesaikan',
        'closed'        => 'Ditutup',
        'rejected'      => 'Ditolak',
    ];

    const PRIORITIES = [
        'low'      => 'Rendah',
        'medium'   => 'Sedang',
        'high'     => 'Tinggi',
        'urgent'   => 'Mendesak',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function resolver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }

    public static function generateTicketNumber(): string
    {
        return 'CPL-' . date('Ym') . '-' . str_pad(
            (self::whereMonth('created_at', now()->month)->count() + 1),
            4, '0', STR_PAD_LEFT
        );
    }

    public function getStatusLabel(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }

    public function getPriorityLabel(): string
    {
        return self::PRIORITIES[$this->priority] ?? ucfirst($this->priority);
    }

    public function isOpen(): bool
    {
        return !in_array($this->status, ['resolved', 'closed', 'rejected']);
    }
}
