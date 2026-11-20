@extends('layouts.app')

@section('title', 'Kategori Layanan Rumah Tangga - HomeService')

@section('content')
<!-- Page Header Breadcrumb -->
<div style="background-color: #FFFFFF; border-bottom: 1px solid var(--hs-border); padding: 32px 0;">
  <div class="hs-container">
    <div style="display: flex; gap: 8px; font-size: 0.8125rem; color: var(--hs-text-secondary); margin-bottom: 8px;">
      <a href="{{ url('/') }}">Beranda</a>
      <span>/</span>
      <span style="color: var(--hs-primary); font-weight: 600;">Semua Kategori</span>
    </div>
    <h1 style="font-size: 2rem; color: var(--hs-primary);">Kategori Layanan Rumah Tangga</h1>
    <p class="hs-subtitle" style="max-width: 680px; margin-top: 6px;">
      Jelajahi 10 spesialisasi perawatan, renovasi, dan perbaikan rumah tangga dari teknisi bersertifikat HomeService.
    </p>
  </div>
</div>

<div class="hs-section">
  <div class="hs-container">
    @php
      $categories = [
        [
          'name' => 'Service AC',
          'slug' => 'service-ac',
          'icon' => 'bi-snow',
          'count' => 12,
          'image' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?q=80&w=600&auto=format&fit=crop',
          'desc' => 'Cuci AC split/cassette, isi & tambah freon R32/R410A, perbaikan kompresor mati, dan ganti pipa bocor.'
        ],
        [
          'name' => 'Instalasi Listrik',
          'slug' => 'instalasi-listrik',
          'icon' => 'bi-lightning-charge',
          'count' => 8,
          'image' => 'https://images.unsplash.com/photo-1558227691-41ea78d1f631?q=80&w=600&auto=format&fit=crop',
          'desc' => 'Pemasangan jalur kabel baru, penataan box panel MCB, instalasi grounding penangkal petir rumah.'
        ],
        [
          'name' => 'Perbaikan Listrik',
          'slug' => 'perbaikan-listrik',
          'icon' => 'bi-plug',
          'count' => 10,
          'image' => 'https://images.unsplash.com/photo-1621905252507-b35492cc74b4?q=80&w=600&auto=format&fit=crop',
          'desc' => 'Deteksi korsleting arus pendek, saklar meleleh, stop kontak terbakar, dan perbaikan lampu jeglek.'
        ],
        [
          'name' => 'Plumbing & Saluran Air',
          'slug' => 'plumbing',
          'icon' => 'bi-droplet-half',
          'count' => 14,
          'image' => 'https://images.unsplash.com/photo-1585704032915-c3400ca199e7?q=80&w=600&auto=format&fit=crop',
          'desc' => 'Pelancaran saluran mampet tanpa bongkar, servis pompa air jetpump, instalasi toren & pipa PVC.'
        ],
        [
          'name' => 'Cleaning Service',
          'slug' => 'cleaning-service',
          'icon' => 'bi-stars',
          'count' => 9,
          'image' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?q=80&w=600&auto=format&fit=crop',
          'desc' => 'Deep cleaning rumah huni & kos, cuci sofa tungau, poles granit marmer, pembersihan kaca tinggi.'
        ],
        [
          'name' => 'Perbaikan Perabot',
          'slug' => 'perbaikan-perabot',
          'icon' => 'bi-hammer',
          'count' => 7,
          'image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=600&auto=format&fit=crop',
          'desc' => 'Reparasi engsel lemari lemot, perbaikan kursi kayu patah, vernis ulang perabot jati & kitchen set.'
        ],
        [
          'name' => 'Tukang Bangunan',
          'slug' => 'tukang-bangunan',
          'icon' => 'bi-bricks',
          'count' => 15,
          'image' => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=600&auto=format&fit=crop',
          'desc' => 'Pasang keramik lantai terangkat (popping), perbaikan atap bocor, plaster dinding retak, renovasi teras.'
        ],
        [
          'name' => 'Pengecatan Rumah',
          'slug' => 'pengecatan-rumah',
          'icon' => 'bi-brush',
          'count' => 6,
          'image' => 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?q=80&w=600&auto=format&fit=crop',
          'desc' => 'Pengecatan exterior tahan cuaca, cat interior aksen dinding, waterproofing dak beton anti bocor.'
        ],
        [
          'name' => 'Pengendalian Hama',
          'slug' => 'pengendalian-hama',
          'icon' => 'bi-shield-shaded',
          'count' => 5,
          'image' => 'https://images.unsplash.com/photo-1584744982491-665216d95f8b?q=80&w=600&auto=format&fit=crop',
          'desc' => 'Pemberantasan rayap pondasi tanah, fogging nyamuk DBD, umpan tikus aman dan pembasmian kecoa.'
        ],
        [
          'name' => 'Perbaikan Elektronik',
          'slug' => 'perbaikan-elektronik',
          'icon' => 'bi-tv',
          'count' => 11,
          'image' => 'https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?q=80&w=600&auto=format&fit=crop',
          'desc' => 'Servis kulkas tidak dingin, mesin cuci mati total, perbaikan dispenser air panas, microwave dan TV LED.'
        ]
      ];
    @endphp

    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
      @foreach($categories as $cat)
        <div class="hs-card hs-card-hover" style="display: flex; gap: 24px; padding: 24px; align-items: center;">
          <div style="width: 140px; height: 140px; border-radius: var(--hs-radius-md); overflow: hidden; flex-shrink: 0; background-color: #E2E8F0;">
            <img src="{{ $cat['image'] }}" alt="{{ $cat['name'] }}" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
          <div style="flex-grow: 1;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
              <span style="font-size: 0.75rem; font-weight: 600; color: #B45309; background: var(--hs-secondary-surface); padding: 3px 10px; border-radius: var(--hs-radius-full);">
                {{ $cat['count'] }} Layanan Tersedia
              </span>
              <i class="bi {{ $cat['icon'] }}" style="font-size: 1.3rem; color: var(--hs-primary);"></i>
            </div>
            <h3 style="font-size: 1.2rem; margin-bottom: 8px;">
              <a href="{{ route('public.services.index', ['category' => $cat['slug']]) }}">{{ $cat['name'] }}</a>
            </h3>
            <p style="font-size: 0.875rem; color: var(--hs-text-secondary); line-height: 1.5; margin-bottom: 14px;">
              {{ $cat['desc'] }}
            </p>
            <a href="{{ route('public.services.index', ['category' => $cat['slug']]) }}" class="hs-btn hs-btn-outline hs-btn-sm">
              Lihat Layanan <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
