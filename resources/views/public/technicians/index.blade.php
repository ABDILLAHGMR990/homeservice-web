@extends('layouts.app')

@section('title', 'Direktori Teknisi Terverifikasi - HomeService')

@section('content')
<div style="background-color: #FFFFFF; border-bottom: 1px solid var(--hs-border); padding: 32px 0;">
  <div class="hs-container">
    <div style="display: flex; gap: 8px; font-size: 0.8125rem; color: var(--hs-text-secondary); margin-bottom: 8px;">
      <a href="{{ url('/') }}">Beranda</a>
      <span>/</span>
      <span style="color: var(--hs-primary); font-weight: 600;">Daftar Teknisi</span>
    </div>
    <h1 style="font-size: 2rem; color: var(--hs-primary);">Teknisi Profesional & Terverifikasi</h1>
    <p class="hs-subtitle" style="margin-top: 4px;">
      Seluruh mitra teknisi HomeService telah lolos verifikasi identitas resmi (KTP), pengecekan rekam jejak, dan sertifikasi keahlian.
    </p>
  </div>
</div>

<div class="hs-section">
  <div class="hs-container">
    <!-- Search & Filter Bar -->
    <div class="hs-card" style="padding: 20px; margin-bottom: 32px;">
      <form action="{{ route('public.technicians.index') }}" method="GET" style="display: grid; grid-template-columns: 2fr 1.2fr 1.2fr auto; gap: 16px; align-items: end;">
        <div>
          <label class="hs-label">Cari Teknisi</label>
          <input type="text" name="q" class="hs-input" placeholder="Nama teknisi atau keahlian (contoh: AC, Listrik)..." value="{{ request('q') }}">
        </div>
        <div>
          <label class="hs-label">Kategori Keahlian</label>
          <select name="category" class="hs-select">
            <option value="">Semua Kategori</option>
            <option value="service-ac">Service AC</option>
            <option value="instalasi-listrik">Instalasi Listrik</option>
            <option value="plumbing">Plumbing & Pipa</option>
            <option value="cleaning">Cleaning Service</option>
            <option value="tukang">Tukang Bangunan</option>
          </select>
        </div>
        <div>
          <label class="hs-label">Area Layanan</label>
          <select name="area" class="hs-select">
            <option value="">Semua Area</option>
            <option value="jakarta-selatan">Jakarta Selatan</option>
            <option value="jakarta-barat">Jakarta Barat</option>
            <option value="jakarta-pusat">Jakarta Pusat</option>
            <option value="tangerang">Tangerang & Tangsel</option>
            <option value="depok">Depok & Bogor</option>
            <option value="bekasi">Bekasi</option>
          </select>
        </div>
        <button type="submit" class="hs-btn hs-btn-primary" style="height: 44px;">
          <i class="bi bi-funnel"></i> Filter
        </button>
      </form>
    </div>

    <!-- Technicians Grid -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
      @if(isset($providers) && $providers->count() > 0)
        @foreach($providers as $prov)
          <x-technician-card
            :name="$prov->name"
            :skill="$prov->providerProfile->expertise ?? 'Spesialis Perbaikan Rumah'"
            avatar="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=300&auto=format&fit=crop"
            :rating="$prov->providerProfile->rating ?? 4.9"
            :completedJobs="$prov->providerProfile->completed_jobs ?? 120"
            :experienceYears="$prov->providerProfile->experience_years ?? 5"
            :url="route('public.technicians.show', ['username' => $prov->id])">
            {{ $prov->providerProfile->bio ?? 'Teknisi profesional terverifikasi KTP resmi di platform HomeService.' }}
          </x-technician-card>
        @endforeach
      @endif

      <!-- Tech 2 -->
      <x-technician-card
        name="Hendra Kusuma"
        skill="Ahli Instalasi Listrik & Panel MCB"
        avatar="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=300&auto=format&fit=crop"
        rating="4.8"
        completedJobs="240"
        experienceYears="6"
        url="{{ route('public.technicians.show', ['username' => 'hendra-kusuma']) }}">
        Berpengalaman menangani korsleting listrik rumah, penataan box sekering dan instalasi stop kontak rapi.
      </x-technician-card>

      <!-- Tech 3 -->
      <x-technician-card
        name="Agus Wibowo"
        skill="Master Plumbing & Saluran Air"
        avatar="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=300&auto=format&fit=crop"
        rating="5.0"
        completedJobs="190"
        experienceYears="8"
        url="{{ route('public.technicians.show', ['username' => 'agus-wibowo']) }}">
        Spesialis pelancaran wastafel mampet, instalasi pompa pendorong otomatis, dan pipa bocor dalam dinding.
      </x-technician-card>

      <!-- Tech 4 -->
      <x-technician-card
        name="Siti Rahmawati"
        skill="Supervisor Cleaning & Sanitasi"
        avatar="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=300&auto=format&fit=crop"
        rating="4.9"
        completedJobs="410"
        experienceYears="5"
        url="{{ route('public.technicians.show', ['username' => 'siti-rahmawati']) }}">
        Layanan pembersihan menyeluruh pasca renovasi, hydro cleaning kasur tungau dan ubin kamar mandi berkerak.
      </x-technician-card>

      <!-- Tech 5 -->
      <x-technician-card
        name="Joko Prasetyo"
        skill="Tukang Bangunan & Renovasi"
        avatar="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?q=80&w=300&auto=format&fit=crop"
        rating="4.7"
        completedJobs="165"
        experienceYears="9"
        url="{{ route('public.technicians.show', ['username' => 'joko-prasetyo']) }}">
        Pakar pasang keramik presisi, waterproofing atap dak beton bocor, plamir dinding, dan renovasi ruangan.
      </x-technician-card>

      <!-- Tech 6 -->
      <x-technician-card
        name="Dedi Irawan"
        skill="Teknisi Elektronik Rumah Tangga"
        avatar="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?q=80&w=300&auto=format&fit=crop"
        rating="4.8"
        completedJobs="210"
        experienceYears="6"
        url="{{ route('public.technicians.show', ['username' => 'dedi-irawan']) }}">
        Perbaikan mesin cuci otomatis, kulkas inverter 2 pintu, dispenser air minum, dan microwave bermasalah.
      </x-technician-card>
    </div>
  </div>
</div>
@endsection
