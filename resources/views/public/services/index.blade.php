@extends('layouts.app')

@section('title', 'Katalog Layanan Rumah Tangga - HomeService')

@section('content')
<div style="background-color: #FFFFFF; border-bottom: 1px solid var(--hs-border); padding: 32px 0;">
  <div class="hs-container">
    <div style="display: flex; gap: 8px; font-size: 0.8125rem; color: var(--hs-text-secondary); margin-bottom: 8px;">
      <a href="{{ url('/') }}">Beranda</a>
      <span>/</span>
      <span style="color: var(--hs-primary); font-weight: 600;">Semua Layanan</span>
    </div>
    <h1 style="font-size: 2rem; color: var(--hs-primary);">Katalog Layanan Lengkap</h1>
    <p class="hs-subtitle" style="margin-top: 4px;">
      Bandingkan harga, durasi pengerjaan, dan pesan teknisi profesional dengan garansi resmi.
    </p>
  </div>
</div>

<div class="hs-section">
  <div class="hs-container">
    <div style="display: grid; grid-template-columns: 280px 1fr; gap: 32px; align-items: start;">
      <!-- Filter Sidebar -->
      <aside class="hs-card" style="padding: 24px;">
        <form action="{{ route('public.services.index') }}" method="GET">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid var(--hs-border); padding-bottom: 12px;">
            <h3 style="font-size: 1.05rem;">Filter Layanan</h3>
            <a href="{{ route('public.services.index') }}" style="font-size: 0.8125rem; color: var(--hs-secondary); font-weight: 600;">Reset</a>
          </div>

          <!-- Filter: Search -->
          <div class="hs-form-group">
            <label class="hs-label">Kata Kunci</label>
            <div class="hs-search-wrap">
              <i class="bi bi-search hs-search-icon"></i>
              <input type="text" name="q" class="hs-input hs-input-search" placeholder="Misal: AC, Pipa..." value="{{ request('q', request('search')) }}">
            </div>
          </div>

          <!-- Filter: Kategori -->
          <div class="hs-form-group">
            <label class="hs-label">Kategori</label>
            <div class="hs-custom-scroll" style="display: flex; flex-direction: column; gap: 9px; max-height: 290px; overflow-y: auto; padding-right: 6px;">
              @php
                $filterCats = [
                  'service-ac' => 'Service AC',
                  'instalasi-listrik' => 'Instalasi Listrik',
                  'perbaikan-listrik' => 'Perbaikan Listrik',
                  'plumbing' => 'Plumbing & Air',
                  'cleaning-service' => 'Cleaning Service',
                  'perbaikan-perabot' => 'Perbaikan Perabot',
                  'tukang-bangunan' => 'Tukang Bangunan',
                  'pengecatan-rumah' => 'Pengecatan Rumah',
                  'pengendalian-hama' => 'Pengendalian Hama',
                  'perbaikan-elektronik' => 'Perbaikan Elektronik'
                ];
              @endphp
              @foreach($filterCats as $slug => $cName)
                <label style="display: flex; align-items: center; gap: 9px; font-size: 0.84375rem; color: var(--hs-text-primary); cursor: pointer; padding: 2px 0;">
                  <input type="radio" name="category" value="{{ $slug }}" {{ request('category') == $slug ? 'checked' : '' }} style="accent-color: var(--hs-primary); width: 15px; height: 15px; flex-shrink: 0;">
                  <span>{{ $cName }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- Filter: Rentang Harga -->
          <div class="hs-form-group">
            <label class="hs-label">Batas Harga Maksimal</label>
            <select name="max_price" class="hs-select">
              <option value="">Semua Rentang Harga</option>
              <option value="100000" {{ request('max_price') == '100000' ? 'selected' : '' }}>Di bawah Rp 100.000</option>
              <option value="250000" {{ request('max_price') == '250000' ? 'selected' : '' }}>Di bawah Rp 250.000</option>
              <option value="500000" {{ request('max_price') == '500000' ? 'selected' : '' }}>Di bawah Rp 500.000</option>
              <option value="1000000" {{ request('max_price') == '1000000' ? 'selected' : '' }}>Di bawah Rp 1.000.000</option>
            </select>
          </div>

          <!-- Filter: Rating -->
          <div class="hs-form-group">
            <label class="hs-label">Rating Teknisi</label>
            <div style="display: flex; flex-direction: column; gap: 8px;">
              <label style="display: flex; align-items: center; gap: 8px; font-size: 0.84375rem; cursor: pointer;">
                <input type="radio" name="rating" value="4.8" {{ request('rating') == '4.8' ? 'checked' : '' }} style="accent-color: var(--hs-secondary);">
                <span style="display: flex; align-items: center; gap: 4px; color: #D97706; font-weight: 600;">
                  <i class="bi bi-star-fill"></i> 4.8 ke atas
                </span>
              </label>
              <label style="display: flex; align-items: center; gap: 8px; font-size: 0.84375rem; cursor: pointer;">
                <input type="radio" name="rating" value="4.5" {{ request('rating') == '4.5' ? 'checked' : '' }} style="accent-color: var(--hs-secondary);">
                <span style="display: flex; align-items: center; gap: 4px; color: #D97706; font-weight: 600;">
                  <i class="bi bi-star-fill"></i> 4.5 ke atas
                </span>
              </label>
            </div>
          </div>

          <button type="submit" class="hs-btn hs-btn-primary" style="width: 100%;">
            <i class="bi bi-funnel-fill"></i> Terapkan Filter
          </button>
        </form>
      </aside>

      <!-- Main Services Listing Content -->
      <div>
        <!-- Top Toolbar -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; background: #FFFFFF; border: 1px solid var(--hs-border); border-radius: var(--hs-radius-md); padding: 12px 18px; flex-wrap: wrap; gap: 12px;">
          <div style="font-size: 0.875rem; color: var(--hs-text-secondary);">
            Menampilkan <strong style="color: var(--hs-primary);">{{ isset($services) ? $services->count() : 0 }}</strong> Layanan Tersedia
          </div>
          <div style="display: flex; align-items: center; gap: 10px;">
            <span style="font-size: 0.8125rem; color: var(--hs-text-secondary);">Urutkan:</span>
            <select class="hs-select" style="padding: 6px 12px; font-size: 0.8125rem; width: auto;" onchange="const url = new URL(window.location.href); url.searchParams.set('sort', this.value); window.location.href = url.toString();">
              <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
              <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
              <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
              <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
            </select>
          </div>
        </div>

        <!-- Services Grid (Dynamic from Database + Fallback Demo Cards if Unfiltered) -->
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
          @if(isset($services) && $services->count() > 0)
            @foreach($services as $svc)
              <x-service-card
                :title="$svc->name"
                :category="$svc->category->name ?? 'Layanan Rumah'"
                :price="$svc->base_price"
                :image="$svc->image ?: 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?q=80&w=600&auto=format&fit=crop'"
                :rating="$svc->reviews_avg_rating ?? 4.9"
                :reviewsCount="$svc->reviews_count ?? 12"
                :url="route('public.services.show', ['slug' => $svc->slug])">
                {{ Str::limit($svc->description, 120) }}
              </x-service-card>
            @endforeach
          @elseif(request()->hasAny(['q', 'search', 'category', 'max_price', 'rating']))
            <div style="grid-column: 1 / -1;">
              <x-empty-state
                icon="bi-search"
                title="Layanan tidak ditemukan"
                description="Coba gunakan kata kunci lain atau reset filter pencarian Anda."
                :action="['label' => 'Reset Filter', 'url' => route('public.services.index')]" />
            </div>
          @endif

          @if(!request()->hasAny(['q', 'search', 'category', 'max_price', 'rating']) && (!isset($services) || $services->count() <= 1))
            <!-- Showcase Fallback Items when initial seeder only has 1 service -->
            <x-service-card
              title="Isi Ulang & Tambah Freon R32 / R410A"
              category="Service AC"
              price="150000"
              image="https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=600&auto=format&fit=crop"
              rating="4.8"
              reviewsCount="195"
              url="{{ route('public.services.index', ['category' => 'service-ac']) }}">
              Pengecekan manifold analyzer, pengisian gas freon original murni, serta deteksi kebocoran flare pipa.
            </x-service-card>

            <x-service-card
              title="Perbaikan Keran Bocor & Saluran Pipa Mampet"
              category="Plumbing & Air"
              price="50000"
              image="https://images.unsplash.com/photo-1585704032915-c3400ca199e7?q=80&w=600&auto=format&fit=crop"
              rating="4.8"
              reviewsCount="238"
              url="{{ route('public.services.index', ['category' => 'plumbing']) }}">
              Mengatasi kran dol, rembesan pipa di balik tembok, dan pembersihan pipa pembuangan lemak wastafel.
            </x-service-card>

            <x-service-card
              title="Instalasi Lampu & Titik Saklar Baru"
              category="Instalasi Listrik"
              price="60000"
              image="https://images.unsplash.com/photo-1558227691-41ea78d1f631?q=80&w=600&auto=format&fit=crop"
              rating="4.9"
              reviewsCount="185"
              url="{{ route('public.services.index', ['category' => 'instalasi-listrik']) }}">
              Pemasangan kabel NYM berstandar SNI, fitting lampu dekoratif, saklar dobel maupun saklar hotel.
            </x-service-card>
          @endif
        </div>

        @if(isset($services) && method_exists($services, 'hasPages') && $services->hasPages())
          <div style="margin-top: 36px;">
            {{ $services->withQueryString()->links('vendor.pagination.homeservice') }}
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
