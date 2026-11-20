<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\BookingStatusLog;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingService
{
    /**
     * FSM: allowed status transitions
     */
    private array $allowedTransitions = [
        'pending'     => ['accepted', 'cancelled', 'rejected'],
        'accepted'    => ['on_the_way', 'cancelled'],
        'on_the_way'  => ['in_progress'],
        'in_progress' => ['completed'],
        'completed'   => [],
        'cancelled'   => [],
        'rejected'    => [],
    ];

    /**
     * Create a new booking with items and initial status log.
     */
    public function createBooking(array $data, User $customer): Booking
    {
        return DB::transaction(function () use ($data, $customer) {
            // Build booking code
            $code = 'HS-' . date('Y') . '-' . str_pad(
                Booking::whereYear('created_at', date('Y'))->count() + 1,
                4, '0', STR_PAD_LEFT
            );

            // Resolve address
            $address = Address::where('id', $data['address_id'])
                ->where('user_id', $customer->id)
                ->firstOrFail();

            // Calculate totals from DB prices (never trust frontend price)
            $items     = collect($data['items']); // [{service_id, quantity, notes}]
            $serviceIds = $items->pluck('service_id');
            $services  = Service::whereIn('id', $serviceIds)->get()->keyBy('id');

            $subtotalAmount = 0;
            $bookingItems   = [];

            foreach ($items as $item) {
                $service  = $services[$item['service_id']];
                $qty      = max(1, (int)$item['quantity']);
                $subtotal = $service->base_price * $qty;

                $subtotalAmount += $subtotal;
                $bookingItems[] = [
                    'service_id'              => $service->id,
                    'service_name_snapshot'   => $service->name,
                    'service_price_snapshot'  => $service->base_price,
                    'quantity'                => $qty,
                    'subtotal'                => $subtotal,
                    'notes'                   => $item['notes'] ?? null,
                ];
            }

            // Create booking
            $booking = Booking::create([
                'booking_code'   => $code,
                'customer_id'    => $customer->id,
                'provider_id'    => $data['provider_id'] ?? null,
                'address_id'     => $address->id,
                'booking_date'   => $data['booking_date'],
                'booking_time'   => $data['booking_time'],
                'notes'          => $data['notes'] ?? null,
                'status'         => 'pending',
                'payment_method' => $data['payment_method'],
                'payment_status' => $data['payment_method'] === 'cash' ? 'unpaid' : 'pending',
                'subtotal'       => $subtotalAmount,
                'platform_fee'   => 0,
                'total_amount'   => $subtotalAmount,
                'address_snapshot' => json_encode([
                    'label'          => $address->label,
                    'recipient_name' => $address->recipient_name,
                    'phone'          => $address->phone,
                    'full_address'   => $address->full_address,
                ]),
            ]);

            // Create booking items
            foreach ($bookingItems as $item) {
                $booking->items()->create($item);
            }

            // Initial status log
            BookingStatusLog::create([
                'booking_id' => $booking->id,
                'from_status'=> null,
                'to_status'  => 'pending',
                'changed_by' => $customer->id,
                'notes'      => 'Pesanan dibuat oleh pelanggan.',
            ]);

            // Create payment record
            Payment::create([
                'booking_id'     => $booking->id,
                'payment_method' => $data['payment_method'],
                'amount'         => $subtotalAmount,
                'platform_fee'   => 0,
                'provider_earning' => $subtotalAmount,
                'status'         => $data['payment_method'] === 'cash' ? 'pending' : 'pending',
            ]);

            return $booking->fresh();
        });
    }

    /**
     * Transition booking status with FSM validation.
     */
    public function transitionStatus(Booking $booking, string $newStatus, User $changedBy, ?string $notes = null): Booking
    {
        $currentStatus = $booking->status;
        $allowed = $this->allowedTransitions[$currentStatus] ?? [];

        if (!in_array($newStatus, $allowed)) {
            throw new \InvalidArgumentException(
                "Transisi dari '{$currentStatus}' ke '{$newStatus}' tidak diizinkan."
            );
        }

        DB::transaction(function () use ($booking, $currentStatus, $newStatus, $changedBy, $notes) {
            $booking->update(['status' => $newStatus]);

            if ($newStatus === 'completed') {
                $booking->update(['completed_at' => now()]);
            }

            BookingStatusLog::create([
                'booking_id'  => $booking->id,
                'from_status' => $currentStatus,
                'to_status'   => $newStatus,
                'changed_by'  => $changedBy->id,
                'notes'       => $notes,
            ]);
        });

        return $booking->fresh();
    }

    /**
     * Cancel a booking (customer or admin only).
     */
    public function cancelBooking(Booking $booking, User $cancelledBy, ?string $reason = null): Booking
    {
        $cancellable = ['pending', 'accepted'];

        if (!in_array($booking->status, $cancellable)) {
            throw new \InvalidArgumentException(
                'Pesanan tidak dapat dibatalkan karena sudah dalam status: ' . $booking->status
            );
        }

        return $this->transitionStatus($booking, 'cancelled', $cancelledBy, $reason ?? 'Dibatalkan.');
    }

    /**
     * Get allowed next statuses for a given role.
     */
    public function getAllowedNextStatuses(Booking $booking, string $role): array
    {
        $all = $this->allowedTransitions[$booking->status] ?? [];

        // Filter by role permissions
        $providerActions  = ['accepted', 'rejected', 'on_the_way', 'in_progress', 'completed'];
        $customerActions  = ['cancelled'];
        $adminActions     = array_merge($providerActions, $customerActions);

        return match ($role) {
            'provider' => array_intersect($all, $providerActions),
            'customer' => array_intersect($all, $customerActions),
            'admin'    => array_intersect($all, $adminActions),
            default    => [],
        };
    }
}
