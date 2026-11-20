@extends('layouts.customer')

@section('title', 'Teknisi Favorit')

@section('content')
<div class="page-header mb-4">
    <h1 class="page-title">Teknisi Favorit</h1>
    <p class="page-subtitle">Teknisi yang pernah Anda tandai sebagai favorit</p>
</div>

@if(isset($favorites) && $favorites->count())
<div class="row g-4">
    @foreach($favorites as $fav)
    <div class="col-md-6 col-lg-4">
        <div class="hs-card p-4">
            <div class="d-flex align-items-start gap-3 mb-3">
                <div class="hs-avatar" style="background:#E5E9EF;color:#687386;font-size:18px;font-weight:600;flex-shrink:0;">
                    {{ substr($fav->name, 0, 1) }}
                </div>
                <div style="flex:1;">
                    <div class="fw-semibold" style="color:#202938;">{{ $fav->name }}</div>
                    <div class="small" style="color:#687386;">{{ $fav->providerProfile?->city ?? '-' }}</div>
                    <div class="d-flex align-items-center gap-1 mt-1">
                        @for($i=1;$i<=5;$i++)
                            <i class="bi bi-star{{ $i <= round($fav->providerProfile?->rating_avg ?? 0) ? '-fill' : '' }}"
                               style="color:#F59E0B;font-size:12px;"></i>
                        @endfor
                        <span class="small ms-1" style="color:#687386;">
                            {{ number_format($fav->providerProfile?->rating_avg ?? 0, 1) }}
                        </span>
                    </div>
                </div>
                <form action="{{ route('customer.favorites.destroy', $fav) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="hs-btn hs-btn-sm" style="color:#DC4444;border:none;background:none;padding:4px;">
                        <i class="bi bi-heart-fill" style="font-size:18px;"></i>
                    </button>
                </form>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('technicians.show', $fav->id) }}"
                   class="hs-btn hs-btn-outline-primary hs-btn-sm flex-1 text-center">
                    Lihat Profil
                </a>
                <a href="{{ route('customer.bookings.create', ['provider_id' => $fav->id]) }}"
                   class="hs-btn hs-btn-secondary hs-btn-sm flex-1 text-center">
                    Pesan
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="hs-card p-5">
    <x-empty-state
        icon="bi-heart"
        title="Belum ada teknisi favorit"
        description="Tambahkan teknisi ke favorit dari halaman profil teknisi untuk akses lebih cepat."
        :action="['label' => 'Cari Teknisi', 'url' => route('public.technicians.index')]" />
</div>
@endif
@endsection
