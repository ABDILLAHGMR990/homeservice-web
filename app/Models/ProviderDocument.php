<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProviderDocument extends Model
{
    protected $fillable = [
        'provider_profile_id',
        'document_type',
        'file_path',
        'status',
        'admin_note',
        'rejection_reason',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    const TYPES = [
        'ktp'         => 'KTP / Kartu Tanda Penduduk',
        'selfie_ktp'  => 'Foto Selfie dengan KTP',
        'certificate' => 'Sertifikat Keahlian',
        'skck'        => 'SKCK',
    ];

    const STATUSES = [
        'pending'  => 'Menunggu Review',
        'approved' => 'Disetujui',
        'rejected' => 'Ditolak',
    ];

    public function providerProfile(): BelongsTo
    {
        return $this->belongsTo(ProviderProfile::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function getTypeLabel(): string
    {
        return self::TYPES[$this->document_type] ?? $this->document_type;
    }

    public function getStatusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }
}
