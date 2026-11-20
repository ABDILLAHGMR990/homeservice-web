@extends('layouts.provider')

@section('title', 'Kelola Layanan Saya - HomeService')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
  <div>
    <h1 style="font-size: 1.75rem; color: var(--hs-primary); margin-bottom: 4px;">Kelola Layanan & Tarif Saya</h1>
    <p style="color: var(--hs-text-secondary); font-size: 0.9375rem;">
      Tentukan layanan yang Anda kuasai, atur tarif standar jasa perbaikan, dan atur ketersediaan order.
    </p>
  </div>
  <button type="button" class="hs-btn hs-btn-primary" data-hs-modal-target="modal-add-service">
    <i class="bi bi-plus-lg"></i> Tambah Layanan Baru
  </button>
</div>

<div class="hs-card" style="padding: 0; overflow: hidden;">
  <div class="hs-table-responsive" style="border: none;">
    <table class="hs-table">
      <thead>
        <tr>
          <th>Nama Layanan</th>
          <th>Kategori</th>
          <th>Tarif Jasa Saya</th>
          <th>Estimasi Waktu</th>
          <th>Status Ketersediaan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div style="font-weight: 700; color: var(--hs-primary);">Cuci & Maintenance AC Split (0.5 - 2 PK)</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">Pembersihan total indoor & outdoor</div>
          </td>
          <td><span class="hs-badge hs-badge-neutral">Service AC</span></td>
          <td><strong style="color: var(--hs-primary);">Rp 75.000</strong></td>
          <td>45 - 60 Menit</td>
          <td>
            <span class="hs-badge" style="background: #E8F7F0; color: #16A36A; border: 1px solid #A7E6CA;">
              <i class="bi bi-check-circle-fill"></i> Aktif Menerima Order
            </span>
          </td>
          <td>
            <div style="display: flex; gap: 6px;">
              <button class="hs-btn hs-btn-outline hs-btn-sm" title="Edit Tarif"><i class="bi bi-pencil"></i></button>
            </div>
          </td>
        </tr>

        <tr>
          <td>
            <div style="font-weight: 700; color: var(--hs-primary);">Tambah / Isi Freon R32 / R410A</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">Pengisian freon murni manifold</div>
          </td>
          <td><span class="hs-badge hs-badge-neutral">Service AC</span></td>
          <td><strong style="color: var(--hs-primary);">Rp 150.000</strong></td>
          <td>30 - 45 Menit</td>
          <td>
            <span class="hs-badge" style="background: #E8F7F0; color: #16A36A; border: 1px solid #A7E6CA;">
              <i class="bi bi-check-circle-fill"></i> Aktif Menerima Order
            </span>
          </td>
          <td>
            <div style="display: flex; gap: 6px;">
              <button class="hs-btn hs-btn-outline hs-btn-sm" title="Edit Tarif"><i class="bi bi-pencil"></i></button>
            </div>
          </td>
        </tr>

        <tr>
          <td>
            <div style="font-weight: 700; color: var(--hs-primary);">Bongkar Pasang Unit AC Split</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">Bongkar unit lama & pasang di titik baru</div>
          </td>
          <td><span class="hs-badge hs-badge-neutral">Service AC</span></td>
          <td><strong style="color: var(--hs-primary);">Rp 250.000</strong></td>
          <td>2 - 3 Jam</td>
          <td>
            <span class="hs-badge" style="background: #E8F7F0; color: #16A36A; border: 1px solid #A7E6CA;">
              <i class="bi bi-check-circle-fill"></i> Aktif Menerima Order
            </span>
          </td>
          <td>
            <div style="display: flex; gap: 6px;">
              <button class="hs-btn hs-btn-outline hs-btn-sm" title="Edit Tarif"><i class="bi bi-pencil"></i></button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Tambah Layanan -->
<div id="modal-add-service" class="hs-modal" style="display: none; position: fixed; inset: 0; background: rgba(20,43,73,0.5); z-index: 9999; align-items: center; justify-content: center;">
  <div class="hs-card" style="width: 100%; max-width: 520px; padding: 32px; background: #FFF;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h3 style="font-size: 1.25rem;">Tambah Layanan Baru</h3>
      <button type="button" class="hs-btn hs-btn-ghost hs-btn-sm" data-hs-modal-close><i class="bi bi-x-lg"></i></button>
    </div>

    <form action="#" method="POST">
      @csrf
      <div class="hs-form-group">
        <label class="hs-label">Pilih Layanan dari Katalog Master</label>
        <select name="service_id" class="hs-select" required>
          <option value="">Pilih Spesifikasi Layanan</option>
          <option value="1">Perbaikan AC Bocor Air</option>
          <option value="2">Penggantian Kapasitor Fan / Kompresor</option>
          <option value="3">Uji Tekanan & Deteksi Kebocoran Pipa</option>
        </select>
      </div>

      <div class="hs-form-group">
        <label class="hs-label">Tarif yang Anda Tawarkan (Rp)</label>
        <input type="number" name="price" class="hs-input" placeholder="Contoh: 120000" min="50000" required>
        <span style="font-size: 0.75rem; color: var(--hs-text-muted); margin-top: 4px; display: block;">Sistem akan memotong komisi 10% untuk platform saat order selesai.</span>
      </div>

      <div class="hs-form-group">
        <label class="hs-label">Estimasi Waktu Pengerjaan (Menit)</label>
        <input type="number" name="duration_minutes" class="hs-input" placeholder="Contoh: 60" required>
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px;">
        <button type="button" class="hs-btn hs-btn-outline" data-hs-modal-close>Batal</button>
        <button type="submit" class="hs-btn hs-btn-primary">Aktifkan Layanan</button>
      </div>
    </form>
  </div>
</div>
@endsection
