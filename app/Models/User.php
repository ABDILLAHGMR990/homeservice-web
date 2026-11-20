<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_active'         => 'boolean',
    ];

    // ─── Role Helpers ─────────────────────────────────────────────────────────

    public function isAdmin(): bool    { return $this->role === 'admin'; }
    public function isProvider(): bool { return $this->role === 'provider'; }
    public function isCustomer(): bool { return $this->role === 'customer'; }

    public function getDashboardRoute(): string
    {
        return match ($this->role) {
            'admin'    => 'admin.dashboard',
            'provider' => 'provider.dashboard',
            default    => 'customer.dashboard',
        };
    }

    // ─── Relationships ───────────────────────────────────────────────────────

    /** Provider profile (1-to-1, only for role=provider) */
    public function providerProfile(): HasOne
    {
        return $this->hasOne(ProviderProfile::class);
    }

    /** Bookings made by this user as customer */
    public function customerBookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }

    /** Bookings assigned to this user as provider */
    public function providerBookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'provider_id');
    }

    /** Addresses belonging to this user */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    /** Reviews written by this user (as customer) */
    public function customerReviews(): HasMany
    {
        return $this->hasMany(Review::class, 'customer_id');
    }

    /** Reviews received by this user (as provider) */
    public function providerReviews(): HasMany
    {
        return $this->hasMany(Review::class, 'provider_id');
    }

    /** Messages sent by this user */
    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /** Messages received by this user */
    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    /** Complaints filed by this user (as customer) */
    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class, 'customer_id');
    }

    // ─── Accessors ────────────────────────────────────────────────────────────

    public function getPrimaryAddressAttribute(): ?Address
    {
        return $this->addresses()->where('is_primary', true)->first()
            ?? $this->addresses()->first();
    }

    public function getRoleLabel(): string
    {
        return match ($this->role) {
            'admin'    => 'Administrator',
            'provider' => 'Teknisi',
            default    => 'Pelanggan',
        };
    }

    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(mb_substr($word, 0, 1));
        }
        return $initials;
    }
}
