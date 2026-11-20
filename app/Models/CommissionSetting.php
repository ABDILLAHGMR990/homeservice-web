<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionSetting extends Model
{
    protected $fillable = [
        'platform_commission_percent',
        'min_withdrawal_amount',
        'warranty_days',
        'max_booking_days_advance',
        'auto_complete_hours',
        'midtrans_server_key',
        'midtrans_client_key',
        'is_production',
    ];

    protected $casts = [
        'platform_commission_percent' => 'decimal:2',
        'min_withdrawal_amount'       => 'decimal:0',
        'is_production'               => 'boolean',
    ];

    protected $hidden = [
        'midtrans_server_key',
    ];

    public static function current(): self
    {
        return self::firstOrCreate([], [
            'platform_commission_percent' => 10.00,
            'min_withdrawal_amount'       => 50000,
            'warranty_days'               => 14,
            'max_booking_days_advance'    => 30,
            'auto_complete_hours'         => 48,
        ]);
    }

    public function calculateCommission(float $amount): array
    {
        $fee      = round($amount * $this->platform_commission_percent / 100);
        $earning  = $amount - $fee;

        return [
            'gross_amount'     => $amount,
            'platform_fee'     => $fee,
            'provider_earning' => $earning,
        ];
    }
}
