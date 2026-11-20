@extends('layouts.customer')

@section('title', 'Alamat Tersimpan - HomeService')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
  <div>
    <h1 style="font-size: 1.75rem; color: var(--hs-primary); margin-bottom: 4px;">Daftar Alamat Pengerjaan</h1>
    <p style="color: var(--hs-text-secondary); font-size: 0.9375rem;">
      Simpan alamat rumah, kantor, atau tempat kos agar proses pemesanan teknisi lebih cepat.
    </p>
  </div>
  <button type="button" class="hs-btn hs-btn-primary" data-hs-modal-target="modal-add-address">
    <i class="bi bi-plus-lg"></i> Tambah Alamat Baru
  </button>
</div>

<!-- Address Cards Grid -->
<div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
  <!-- Address 1 (Primary) -->
  <div class="hs-card" style="border: 2px solid var(--hs-primary); position: relative;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
      <div style="display: flex; align-items: center; gap: 8px;">
        <span style="font-weight: 700; color: var(--hs-primary); font-size: 1.1rem;">Rumah Pribadi</span>
        <span class="hs-badge" style="background: var(--hs-primary-surface); color: var(--hs-primary);">Alamat Utama</span>
      </div>
      <div style="display: flex; gap: 6px;">
        <button class="hs-btn hs-btn-ghost hs-btn-sm" title="Edit"><i class="bi bi-pencil"></i></button>
      </div>
    </div>

    <div style="font-weight: 600; color: var(--hs-primary); font-size: 0.9375rem; margin-bottom: 4px;">
      Dian Anggraini (0812-3456-7890)
    </div>

    <p style="font-size: 0.875rem; color: var(--hs-text-secondary); line-height: 1.5; margin-bottom: 14px;">
      Jl. Tebet Barat Dalam Raya No. 42B, RT 04 / RW 02, Kelurahan Tebet Barat, Kecamatan Tebet, Kota Jakarta Selatan, DKI Jakarta 12810.
    </p>

    <div style="background: var(--hs-bg-main); padding: 10px 14px; border-radius: var(--hs-radius-md); font-size: 0.8125rem; color: #B45309;">
      <i class="bi bi-geo-alt"></i> Patokan: Rumah pagar hitam samping laundry express.
    </div>
  </div>

  <!-- Address 2 -->
  <div class="hs-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
      <div style="display: flex; align-items: center; gap: 8px;">
        <span style="font-weight: 700; color: var(--hs-primary); font-size: 1.1rem;">Kost Mahasiswa</span>
      </div>
      <div style="display: flex; gap: 6px;">
        <button class="hs-btn hs-btn-ghost hs-btn-sm" title="Jadikan Utama"><i class="bi bi-check2"></i></button>
        <button class="hs-btn hs-btn-ghost hs-btn-sm" title="Edit"><i class="bi bi-pencil"></i></button>
      </div>
    </div>

    <div style="font-weight: 600; color: var(--hs-primary); font-size: 0.9375rem; margin-bottom: 4px;">
      Dian Anggraini (0812-3456-7890)
    </div>

    <p style="font-size: 0.875rem; color: var(--hs-text-secondary); line-height: 1.5; margin-bottom: 14px;">
      Kost Griya Asri Kamar 12, Jl. Margonda Raya No. 18, Kemiri Muka, Kecamatan Beji, Kota Depok, Jawa Barat 16423.
    </p>

    <div style="background: var(--hs-bg-main); padding: 10px 14px; border-radius: var(--hs-radius-md); font-size: 0.8125rem; color: #B45309;">
      <i class="bi bi-geo-alt"></i> Patokan: Gang sebelah minimarket, pagar warna abu-abu.
    </div>
  </div>
</div>

<!-- Modal Tambah Alamat Baru -->
<div id="modal-add-address" class="hs-modal" style="display: none; position: fixed; inset: 0; background: rgba(20,43,73,0.5); z-index: 9999; align-items: center; justify-content: center;">
  <div class="hs-card" style="width: 100%; max-width: 540px; padding: 32px; background: #FFF;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h3 style="font-size: 1.25rem;">Tambah Alamat Baru</h3>
      <button type="button" class="hs-btn hs-btn-ghost hs-btn-sm" data-hs-modal-close><i class="bi bi-x-lg"></i></button>
    </div>

    <form action="#" method="POST">
      @csrf
      <div class="hs-form-group">
        <label class="hs-label">Label Alamat (Contoh: Rumah, Kos, Kantor)</label>
        <input type="text" class="hs-input" placeholder="Rumah Orang Tua..." required>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
        <div class="hs-form-group">
          <label class="hs-label">Nama Penerima</label>
          <input type="text" class="hs-input" placeholder="Nama Anda" required>
        </div>
        <div class="hs-form-group">
          <label class="hs-label">Nomor Telepon / WA</label>
          <input type="tel" class="hs-input" placeholder="08xxxxxxxxxx" required>
        </div>
      </div>

      <div class="hs-form-group">
        <label class="hs-label">Alamat Jalan Lengkap (RT/RW, No. Rumah)</label>
        <textarea class="hs-textarea" placeholder="Tuliskan nama jalan, blok, nomor rumah selengkapnya..." required></textarea>
      </div>

      <div class="hs-form-group">
        <label class="hs-label">Patokan Lokasi (Sangat Membantu Teknisi)</label>
        <input type="text" class="hs-input" placeholder="Warna pagar, dekat warung/masjid...">
      </div>

      <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 24px;">
        <button type="button" class="hs-btn hs-btn-outline" data-hs-modal-close>Batal</button>
        <button type="submit" class="hs-btn hs-btn-primary">Simpan Alamat</button>
      </div>
    </form>
  </div>
</div>
@endsection
