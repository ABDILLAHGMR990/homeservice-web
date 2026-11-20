@extends('layouts.admin')

@section('title', 'Master Standar Layanan - HomeService Admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
  <div>
    <h1 style="font-size: 1.75rem; color: var(--hs-primary); margin-bottom: 4px;">Master Standar Layanan</h1>
    <p style="color: var(--hs-text-secondary); font-size: 0.9375rem;">
      Konfigurasi standar layanan platform, tarif acuan pasar, dan aturan estimasi pengerjaan.
    </p>
  </div>
  <button type="button" class="hs-btn hs-btn-primary" data-hs-modal-target="modal-add-master-service">
    <i class="bi bi-plus-lg"></i> Tambah Master Layanan
  </button>
</div>

<div class="hs-card" style="padding: 0; overflow: hidden;">
  <div class="hs-table-responsive" style="border: none;">
    <table class="hs-table">
      <thead>
        <tr>
          <th>Nama Layanan</th>
          <th>Kategori</th>
          <th>Tarif Rekomendasi</th>
          <th>Estimasi Waktu</th>
          <th>Mitra Tersedia</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div style="font-weight: 700; color: var(--hs-primary);">Cuci & Maintenance AC Split (0.5 - 2 PK)</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">service-ac/cuci-maintenance-ac-split</div>
          </td>
          <td><span class="hs-badge hs-badge-neutral">Service AC</span></td>
          <td><strong style="color: var(--hs-primary);">Rp 75.000</strong></td>
          <td>45 - 60 Menit</td>
          <td>42 Teknisi</td>
          <td><span class="hs-badge hs-badge-completed">Aktif Dipasarkan</span></td>
          <td>
            <div style="display: flex; gap: 6px;">
              <button class="hs-btn hs-btn-outline hs-btn-sm" title="Edit"><i class="bi bi-pencil"></i></button>
            </div>
          </td>
        </tr>

        <tr>
          <td>
            <div style="font-weight: 700; color: var(--hs-primary);">Perbaikan Keran Bocor & Pipa Mampet</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">plumbing/perbaikan-keran-bocor</div>
          </td>
          <td><span class="hs-badge hs-badge-neutral">Plumbing & Air</span></td>
          <td><strong style="color: var(--hs-primary);">Rp 50.000</strong></td>
          <td>30 - 60 Menit</td>
          <td>35 Teknisi</td>
          <td><span class="hs-badge hs-badge-completed">Aktif Dipasarkan</span></td>
          <td>
            <div style="display: flex; gap: 6px;">
              <button class="hs-btn hs-btn-outline hs-btn-sm" title="Edit"><i class="bi bi-pencil"></i></button>
            </div>
          </td>
        </tr>

        <tr>
          <td>
            <div style="font-weight: 700; color: var(--hs-primary);">Instalasi Lampu & Titik Saklar Baru</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">instalasi-listrik/instalasi-lampu-saklar</div>
          </td>
          <td><span class="hs-badge hs-badge-neutral">Instalasi Listrik</span></td>
          <td><strong style="color: var(--hs-primary);">Rp 60.000</strong></td>
          <td>45 Menit</td>
          <td>38 Teknisi</td>
          <td><span class="hs-badge hs-badge-completed">Aktif Dipasarkan</span></td>
          <td>
            <div style="display: flex; gap: 6px;">
              <button class="hs-btn hs-btn-outline hs-btn-sm" title="Edit"><i class="bi bi-pencil"></i></button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Tambah Master Layanan -->
<div id="modal-add-master-service" class="hs-modal" style="display: none; position: fixed; inset: 0; background: rgba(20,43,73,0.5); z-index: 9999; align-items: center; justify-content: center;">
  <div class="hs-card" style="width: 100%; max-width: 520px; padding: 32px; background: #FFF;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h3 style="font-size: 1.25rem;">Tambah Standar Layanan Baru</h3>
      <button type="button" class="hs-btn hs-btn-ghost hs-btn-sm" data-hs-modal-close><i class="bi bi-x-lg"></i></button>
    </div>

    <form action="#" method="POST" onsubmit="event.preventDefault(); window.showToast('Standar layanan baru berhasil disimpan!', 'success'); document.getElementById('modal-add-master-service').classList.remove('hs-modal-active');">
      @csrf
      <div class="hs-form-group">
        <label class="hs-label">Kategori</label>
        <select name="category_id" class="hs-select" required>
          <option value="1">Service AC</option>
          <option value="2">Instalasi Listrik</option>
          <option value="3">Plumbing & Saluran Air</option>
          <option value="4">Cleaning Service</option>
        </select>
      </div>

      <div class="hs-form-group">
        <label class="hs-label">Nama Layanan</label>
        <input type="text" class="hs-input" placeholder="Contoh: Pembersihan Toren Air 500-1000 Liter" required>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
        <div class="hs-form-group">
          <label class="hs-label">Tarif Rekomendasi (Rp)</label>
          <input type="number" class="hs-input" placeholder="100000" required>
        </div>
        <div class="hs-form-group">
          <label class="hs-label">Estimasi Waktu (Menit)</label>
          <input type="number" class="hs-input" placeholder="60" required>
        </div>
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px;">
        <button type="button" class="hs-btn hs-btn-outline" data-hs-modal-close>Batal</button>
        <button type="submit" class="hs-btn hs-btn-primary">Simpan Layanan</button>
      </div>
    </form>
  </div>
</div>
@endsection
