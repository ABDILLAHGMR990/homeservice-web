@extends('layouts.customer')

@section('title', 'Notifikasi')

@section('content')
<div class="page-header d-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="page-title">Notifikasi</h1>
        <p class="page-subtitle">Pembaruan pesanan dan aktivitas akun Anda</p>
    </div>
    <form action="{{ route('customer.notifications.read-all') }}" method="POST">
        @csrf
        <button type="submit" class="hs-btn hs-btn-outline-primary hs-btn-sm">
            <i class="bi bi-check2-all me-1"></i>Tandai Semua Dibaca
        </button>
    </form>
</div>

{{-- Filter Tabs --}}
<div class="hs-tabs mb-4">
    <a href="?tab=all" class="hs-tab {{ request('tab','all') === 'all' ? 'hs-tab-active' : '' }}">Semua</a>
    <a href="?tab=booking" class="hs-tab {{ request('tab') === 'booking' ? 'hs-tab-active' : '' }}">Pesanan</a>
    <a href="?tab=payment" class="hs-tab {{ request('tab') === 'payment' ? 'hs-tab-active' : '' }}">Pembayaran</a>
    <a href="?tab=promo" class="hs-tab {{ request('tab') === 'promo' ? 'hs-tab-active' : '' }}">Promo</a>
</div>

{{-- Notification List --}}
<div class="hs-card overflow-hidden">
    @php
    $demoNotifs = [
        ['icon'=>'bi-check-circle-fill','color'=>'#16A36A','bg'=>'#ECFDF5','title'=>'Pesanan Dikonfirmasi','desc'=>'Pesanan HS-2026-0001 (Servis AC) telah dikonfirmasi oleh teknisi Budi Perkasa.','time'=>'2 menit lalu','read'=>false,'type'=>'booking'],
        ['icon'=>'bi-person-walking','color'=>'#3B82F6','bg'=>'#EFF6FF','title'=>'Teknisi Dalam Perjalanan','desc'=>'Budi Perkasa sedang dalam perjalanan menuju lokasi Anda. Estimasi tiba 15 menit.','time'=>'20 menit lalu','read'=>false,'type'=>'booking'],
        ['icon'=>'bi-credit-card-fill','color'=>'#F59E0B','bg'=>'#FFFBEB','title'=>'Pembayaran Berhasil','desc'=>'Pembayaran Rp 350.000 untuk pesanan HS-2026-0001 telah berhasil diproses.','time'=>'1 jam lalu','read'=>true,'type'=>'payment'],
        ['icon'=>'bi-star-fill','color'=>'#F59E0B','bg'=>'#FFFBEB','title'=>'Berikan Ulasan Anda','desc'=>'Pesanan HS-2026-0001 telah selesai. Bagikan pengalaman Anda untuk membantu pengguna lain.','time'=>'3 jam lalu','read'=>true,'type'=>'booking'],
        ['icon'=>'bi-tag-fill','color'=>'#8B5CF6','bg'=>'#F5F3FF','title'=>'Promo Spesial: Diskon 20%','desc'=>'Dapatkan diskon 20% untuk layanan Cleaning Service setiap Senin. Gunakan kode SENIN20.','time'=>'1 hari lalu','read'=>true,'type'=>'promo'],
        ['icon'=>'bi-shield-check-fill','color'=>'#16A36A','bg'=>'#ECFDF5','title'=>'Garansi Aktif','desc'=>'Garansi 7 hari untuk pesanan HS-2026-0001 telah aktif hingga 24 November 2026.','time'=>'2 hari lalu','read'=>true,'type'=>'booking'],
    ];
    $tab = request('tab','all');
    $filtered = $tab === 'all' ? $demoNotifs : array_filter($demoNotifs, fn($n) => $n['type'] === $tab);
    @endphp

    @forelse($filtered as $notif)
    <div class="d-flex gap-3 p-4 border-bottom {{ !$notif['read'] ? 'notif-unread' : '' }}"
         style="border-color:#E5E9EF;background:{{ !$notif['read'] ? '#FAFBFF' : '#fff' }};transition:background 0.2s;">
        <div class="flex-shrink-0 d-flex align-items-center justify-content-center"
             style="width:44px;height:44px;border-radius:12px;background:{{ $notif['bg'] }};">
            <i class="bi {{ $notif['icon'] }}" style="color:{{ $notif['color'] }};font-size:18px;"></i>
        </div>
        <div style="flex:1;">
            <div class="d-flex justify-content-between align-items-start">
                <div class="fw-semibold" style="color:#202938;font-size:14px;">
                    {{ $notif['title'] }}
                    @if(!$notif['read'])
                        <span style="display:inline-block;width:7px;height:7px;border-radius:50%;background:#3B82F6;vertical-align:middle;margin-left:6px;"></span>
                    @endif
                </div>
                <span class="small flex-shrink-0 ms-3" style="color:#687386;">{{ $notif['time'] }}</span>
            </div>
            <p class="mb-0 mt-1" style="color:#687386;font-size:13px;line-height:1.5;">
                {{ $notif['desc'] }}
            </p>
        </div>
    </div>
    @empty
    <div class="p-5">
        <x-empty-state
            icon="bi-bell-slash"
            title="Tidak ada notifikasi"
            description="Notifikasi baru akan muncul di sini." />
    </div>
    @endforelse
</div>
@endsection
