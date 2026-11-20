@extends('layouts.admin')

@section('title', 'Master Kategori Layanan - HomeService Admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
  <div>
    <h1 style="font-size: 1.75rem; color: var(--hs-primary); margin-bottom: 4px;">Master Kategori Layanan</h1>
    <p style="color: var(--hs-text-secondary); font-size: 0.9375rem;">
      Kelola 10 kelompok spesialisasi pekerjaan rumah tangga pada platform HomeService.
    </p>
  </div>
  <button type="button" class="hs-btn hs-btn-primary" data-hs-modal-target="modal-add-category">
    <i class="bi bi-plus-lg"></i> Tambah Kategori Baru
  </button>
</div>

<div class="hs-card" style="padding: 0; overflow: hidden;">
  <div class="hs-table-responsive" style="border: none;">
    <table class="hs-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Kategori</th>
          <th>Slug URL</th>
          <th>Icon</th>
          <th>Jumlah Layanan</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @php
          $cats = [
            ['id' => 1, 'name' => 'Service AC', 'slug' => 'service-ac', 'icon' => 'bi-snow', 'services' => 12],
            ['id' => 2, 'name' => 'Instalasi Listrik', 'slug' => 'instalasi-listrik', 'icon' => 'bi-lightning-charge', 'services' => 8],
            ['id' => 3, 'name' => 'Perbaikan Listrik', 'slug' => 'perbaikan-listrik', 'icon' => 'bi-plug', 'services' => 10],
            ['id' => 4, 'name' => 'Plumbing & Saluran Air', 'slug' => 'plumbing', 'icon' => 'bi-droplet-half', 'services' => 14],
            ['id' => 5, 'name' => 'Cleaning Service', 'slug' => 'cleaning-service', 'icon' => 'bi-stars', 'services' => 9],
            ['id' => 6, 'name' => 'Perbaikan Perabot', 'slug' => 'perbaikan-perabot', 'icon' => 'bi-hammer', 'services' => 7],
            ['id' => 7, 'name' => 'Tukang Bangunan', 'slug' => 'tukang-bangunan', 'icon' => 'bi-bricks', 'services' => 15],
            ['id' => 8, 'name' => 'Pengecatan Rumah', 'slug' => 'pengecatan-rumah', 'icon' => 'bi-brush', 'services' => 6],
            ['id' => 9, 'name' => 'Pengendalian Hama', 'slug' => 'pengendalian-hama', 'icon' => 'bi-shield-shaded', 'services' => 5],
            ['id' => 10, 'name' => 'Perbaikan Elektronik', 'slug' => 'perbaikan-elektronik', 'icon' => 'bi-tv', 'services' => 11],
          ];
        @endphp
        @foreach($cats as $c)
          <tr>
            <td>{{ $c['id'] }}</td>
            <td><strong style="color: var(--hs-primary);">{{ $c['name'] }}</strong></td>
            <td><code>{{ $c['slug'] }}</code></td>
            <td><i class="bi {{ $c['icon'] }}" style="font-size: 1.25rem; color: var(--hs-primary);"></i></td>
            <td>{{ $c['services'] }} Layanan</td>
            <td><span class="hs-badge hs-badge-completed">Aktif Ditampilkan</span></td>
            <td>
              <div style="display: flex; gap: 6px;">
                <button class="hs-btn hs-btn-outline hs-btn-sm" title="Edit"><i class="bi bi-pencil"></i></button>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Tambah Kategori -->
<div id="modal-add-category" class="hs-modal" style="display: none; position: fixed; inset: 0; background: rgba(20,43,73,0.5); z-index: 9999; align-items: center; justify-content: center;">
  <div class="hs-card" style="width: 100%; max-width: 480px; padding: 32px; background: #FFF;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h3 style="font-size: 1.25rem;">Tambah Kategori Baru</h3>
      <button type="button" class="hs-btn hs-btn-ghost hs-btn-sm" data-hs-modal-close><i class="bi bi-x-lg"></i></button>
    </div>

    <form action="#" method="POST" onsubmit="event.preventDefault(); window.showToast('Kategori baru berhasil ditambahkan!', 'success'); document.getElementById('modal-add-category').classList.remove('hs-modal-active');">
      @csrf
      <div class="hs-form-group">
        <label class="hs-label">Nama Kategori</label>
        <input type="text" class="hs-input" placeholder="Contoh: Otomotif & Cuci Mobil" required>
      </div>

      <div class="hs-form-group">
        <label class="hs-label">Slug URL</label>
        <input type="text" class="hs-input" placeholder="otomotif-cuci-mobil" required>
      </div>

      <div class="hs-form-group">
        <label class="hs-label">Class Icon (Bootstrap Icons)</label>
        <input type="text" class="hs-input" placeholder="bi-car-front" required>
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px;">
        <button type="button" class="hs-btn hs-btn-outline" data-hs-modal-close>Batal</button>
        <button type="submit" class="hs-btn hs-btn-primary">Simpan Kategori</button>
      </div>
    </form>
  </div>
</div>
@endsection
