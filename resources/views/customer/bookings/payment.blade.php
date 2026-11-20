@extends('layouts.customer')

@section('title', 'Pembayaran - ' . $booking->booking_code)

@section('content')
<div class="container" style="max-width:640px;margin:0 auto;">

    <div class="page-header mb-4">
        <h1 class="page-title">Pembayaran</h1>
        <p class="page-subtitle">Selesaikan pembayaran untuk pesanan <strong>{{ $booking->booking_code }}</strong></p>
    </div>

    {{-- Order Summary --}}
    <div class="hs-card p-4 mb-4">
        <h6 class="fw-semibold mb-3" style="color:#202938;">Ringkasan Pesanan</h6>

        @foreach($booking->items as $item)
        <div class="d-flex justify-content-between align-items-center py-2 border-bottom" style="border-color:#E5E9EF!important;">
            <div>
                <div class="fw-medium" style="color:#202938;">{{ $item->service_name_snapshot }}</div>
                <div class="small" style="color:#687386;">{{ $item->quantity }}x @ {{ $item->formatted_price }}</div>
            </div>
            <div class="fw-semibold" style="color:#202938;">{{ $item->formatted_subtotal }}</div>
        </div>
        @endforeach

        <div class="d-flex justify-content-between align-items-center pt-3">
            <div class="fw-semibold" style="color:#202938;">Total Pembayaran</div>
            <div class="fw-bold" style="color:#142B49;font-size:1.1rem;">
                Rp {{ number_format($booking->total_amount, 0, ',', '.') }}
            </div>
        </div>
    </div>

    {{-- Payment Button --}}
    <div class="hs-card p-4 text-center">
        <div class="mb-3">
            <i class="bi bi-shield-check" style="font-size:40px;color:#16A36A;"></i>
            <h6 class="fw-semibold mt-2 mb-1" style="color:#202938;">Pembayaran Aman</h6>
            <p class="small" style="color:#687386;">Transaksi diproses melalui Midtrans dengan enkripsi SSL</p>
        </div>

        @if(isset($snapToken))
            <button id="pay-button" class="hs-btn hs-btn-secondary w-100" style="padding:14px;">
                <i class="bi bi-credit-card me-2"></i>Bayar Sekarang
            </button>
        @else
            <div class="hs-alert hs-alert-warning mb-3">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Gagal memuat halaman pembayaran. Silakan coba lagi.
            </div>
            <a href="{{ route('customer.bookings.show', $booking->booking_code) }}"
               class="hs-btn hs-btn-outline-primary">
                Kembali ke Pesanan
            </a>
        @endif

        <div class="mt-3">
            <img src="https://midtrans.com/assets/images/logo.png" alt="Midtrans"
                 style="height:24px;opacity:0.6;" onerror="this.style.display='none'">
        </div>
    </div>

</div>
@endsection

@if(isset($snapToken))
@push('scripts')
<script src="{{ $isProduction ? 'https://app.midtrans.com' : 'https://app.sandbox.midtrans.com' }}/snap/snap.js"
        data-client-key="{{ $clientKey }}"></script>
<script>
document.getElementById('pay-button').onclick = function () {
    const btn = this;
    btn.disabled = true;
    btn.innerHTML = '<span class="hs-spinner-sm me-2"></span>Memuat pembayaran...';

    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result) {
            window.location.href = "{{ route('customer.bookings.show', $booking->booking_code) }}?payment=success";
        },
        onPending: function(result) {
            window.location.href = "{{ route('customer.bookings.show', $booking->booking_code) }}?payment=pending";
        },
        onError: function(result) {
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-credit-card me-2"></i>Bayar Sekarang';
            alert('Pembayaran gagal. Silakan coba lagi.');
        },
        onClose: function() {
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-credit-card me-2"></i>Bayar Sekarang';
        }
    });
};
</script>
@endpush
@endif
