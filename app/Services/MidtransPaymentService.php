<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MidtransPaymentService
{
    private string $serverKey;
    private string $clientKey;
    private bool   $isProduction;
    private string $baseUrl;

    public function __construct()
    {
        $this->serverKey    = config('midtrans.server_key', '');
        $this->clientKey    = config('midtrans.client_key', '');
        $this->isProduction = config('midtrans.is_production', false);
        $this->baseUrl      = $this->isProduction
            ? 'https://app.midtrans.com'
            : 'https://app.sandbox.midtrans.com';
    }

    /**
     * Create a Midtrans Snap transaction and return snap token.
     */
    public function createSnapToken(Booking $booking): array
    {
        $payload = [
            'transaction_details' => [
                'order_id'     => $booking->booking_code . '-' . time(),
                'gross_amount' => (int)$booking->total_amount,
            ],
            'customer_details' => [
                'first_name' => $booking->customer->name,
                'email'      => $booking->customer->email,
                'phone'      => $booking->customer->phone ?? '',
            ],
            'item_details' => $booking->items->map(function ($item) {
                return [
                    'id'       => $item->service_id ?? 'SVC-' . $item->id,
                    'price'    => (int)$item->service_price_snapshot,
                    'quantity' => $item->quantity,
                    'name'     => $item->service_name_snapshot,
                ];
            })->toArray(),
            'callbacks' => [
                'finish' => route('customer.bookings.show', $booking->booking_code),
            ],
        ];

        $response = Http::withBasicAuth($this->serverKey, '')
            ->post($this->baseUrl . '/snap/v1/transactions', $payload);

        if ($response->failed()) {
            Log::error('Midtrans createSnapToken failed', [
                'booking_code' => $booking->booking_code,
                'response'     => $response->json(),
            ]);
            throw new \RuntimeException('Gagal membuat transaksi pembayaran. Coba lagi nanti.');
        }

        $data     = $response->json();
        $token    = $data['token'];
        $snapUrl  = $data['redirect_url'];

        // Update payment record
        $booking->payment()->update([
            'midtrans_order_id'   => $payload['transaction_details']['order_id'],
            'midtrans_snap_token' => $token,
            'midtrans_snap_url'   => $snapUrl,
            'status'              => 'pending',
        ]);

        return [
            'token'       => $token,
            'redirect_url'=> $snapUrl,
            'client_key'  => $this->clientKey,
        ];
    }

    /**
     * Verify Midtrans webhook signature and handle notification.
     */
    public function handleWebhook(array $payload): void
    {
        // Verify signature
        $orderId           = $payload['order_id'];
        $statusCode        = $payload['status_code'];
        $grossAmount       = $payload['gross_amount'];
        $serverKey         = $this->serverKey;
        $signatureKey      = $payload['signature_key'];

        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if (!hash_equals($expectedSignature, $signatureKey)) {
            Log::warning('Midtrans webhook: invalid signature', ['order_id' => $orderId]);
            throw new \InvalidArgumentException('Invalid webhook signature.');
        }

        // Find booking code from order_id (order_id = booking_code + '-' + timestamp)
        $bookingCode = explode('-', $orderId);
        // booking code format: HS-YYYY-NNNN — take first 3 segments
        $code = implode('-', array_slice($bookingCode, 0, 3));

        $payment = Payment::where('midtrans_order_id', $orderId)->first();

        if (!$payment) {
            Log::warning('Midtrans webhook: payment not found', ['order_id' => $orderId]);
            return;
        }

        $transactionStatus = $payload['transaction_status'];
        $fraudStatus       = $payload['fraud_status'] ?? null;

        $newStatus = match (true) {
            $transactionStatus === 'capture' && $fraudStatus === 'accept' => 'paid',
            $transactionStatus === 'settlement'                           => 'paid',
            in_array($transactionStatus, ['cancel', 'expire', 'deny'])   => 'failed',
            $transactionStatus === 'refund'                               => 'refunded',
            default                                                       => $payment->status,
        };

        $payment->update([
            'status'                      => $newStatus,
            'midtrans_transaction_id'     => $payload['transaction_id'] ?? null,
            'midtrans_payment_type'       => $payload['payment_type'] ?? null,
            'midtrans_raw_response'       => $payload,
            'paid_at'                     => $newStatus === 'paid' ? now() : null,
        ]);

        // Update booking payment_status
        if ($newStatus === 'paid') {
            $payment->booking()->update(['payment_status' => 'paid']);
        }

        Log::info('Midtrans webhook processed', [
            'order_id'   => $orderId,
            'new_status' => $newStatus,
        ]);
    }

    public function getClientKey(): string
    {
        return $this->clientKey;
    }

    public function isProduction(): bool
    {
        return $this->isProduction;
    }
}
