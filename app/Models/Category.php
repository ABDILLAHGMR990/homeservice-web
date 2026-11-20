<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'image_path',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    // ─── Relationships ───────────────────────────────────────────────────────

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    public function getIconClassAttribute(): string
    {
        $iconMap = [
            'ac'           => 'bi-thermometer-half',
            'listrik'      => 'bi-lightning-charge',
            'ledeng'       => 'bi-droplet',
            'kebersihan'   => 'bi-stars',
            'elektronik'   => 'bi-cpu',
            'renovasi'     => 'bi-tools',
            'pengecatan'   => 'bi-brush',
            'taman'        => 'bi-tree',
            'keamanan'     => 'bi-shield-check',
            'laundry'      => 'bi-basket',
        ];

        foreach ($iconMap as $key => $icon) {
            if (str_contains(strtolower($this->slug ?? ''), $key)) {
                return $icon;
            }
        }

        return $this->icon ?? 'bi-wrench-adjustable';
    }
}
