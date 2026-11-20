@extends('layouts.customer')

@section('title', 'Pusat Pengaduan & Garansi - HomeService')

@section('content')
<div style="margin-bottom: 24px;">
  <h1 style="font-size: 1.75rem; color: var(--hs-primary); margin-bottom: 4px;">Pusat Pengaduan & Klaim Garansi</h1>
  <p style="color: var(--hs-text-secondary); font-size: 0.9375rem;">
    Setiap pesanan dilindungi garansi 14 hari. Laporkan kendala pengerjaan untuk dijadwalkan kunjungan perbaikan ulang.
  </p>
</div>

<div style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 32px; align-items: start;">
  <!-- Left Column: Complaint Form -->
  <div class="hs-card">
    <h3 style="font-size: 1.2rem; color: var(--hs-primary); margin-bottom: 16px;">Ajukan Tiket Pengaduan Baru</h3>
    <form action="#" method="POST" data-loading-state>
      @csrf
      <div class="hs-form-group">
        <label class="hs-label">Pilih Pesanan yang Bermasalah</label>
        <select name="booking_code" class="hs-select" required>
          <option value="">Pilih Transaksi Selesai</option>
          <option value="HS-2025-084">#HS-2025-084 - Perbaikan Keran Bocor Wastafel (Agus Wibowo)</option>
          <option value="HS-2025-062">#HS-2025-062 - Instalasi Titik Lampu Downlight (Hendra Kusuma)</option>
        </select>
      </div>

      <div class="hs-form-group">
        <label class="hs-label">Kategori Kendala</label>
        <select name="issue_category" class="hs-select" required>
          <option value="garansi_ulang">Klaim Garansi (Masalah yang sama kambuh lagi)</option>
          <option value="kerusakan_barang">Kerusakan Alat/Barang saat Pengerjaan</option>
          <option value="ketidaksesuaian_biaya">Ketidaksesuaian Tarif / Biaya Tambahan</option>
          <option value="perilaku_teknisi">Sikap atau Ketidaksopanan Teknisi</option>
        </select>
      </div>

      <div class="hs-form-group">
        <label class="hs-label">Deskripsi Lengkap Kendala</label>
        <textarea name="description" class="hs-textarea" placeholder="Jelaskan secara detail kendala yang timbul agar tim operasional dapat segera menginvestigasi..." required></textarea>
      </div>

      <button type="submit" class="hs-btn hs-btn-danger hs-btn-lg" style="width: 100%;">
        Kirimkan Pengaduan <i class="bi bi-shield-exclamation"></i>
      </button>
    </form>
  </div>

  <!-- Right Column: Active Tickets & Rules -->
  <div>
    <div class="hs-card" style="margin-bottom: 24px;">
      <h3 style="font-size: 1.1rem; color: var(--hs-primary); margin-bottom: 12px;">Ketentuan Garansi 14 Hari</h3>
      <ul style="list-style: none; display: flex; flex-direction: column; gap: 10px; font-size: 0.8125rem; color: var(--hs-text-secondary); line-height: 1.5;">
        <li style="display: flex; gap: 8px;"><i class="bi bi-check-circle-fill" style="color: #16A36A;"></i> Kunjungan teknisi kedua bebas biaya jasa pengerjaan.</li>
        <li style="display: flex; gap: 8px;"><i class="bi bi-check-circle-fill" style="color: #16A36A;"></i> Laporan ditindaklanjuti customer support dalam 1x24 jam.</li>
        <li style="display: flex; gap: 8px;"><i class="bi bi-check-circle-fill" style="color: #16A36A;"></i> Anda dapat meminta penggantian teknisi yang berbeda.</li>
      </ul>
    </div>

    <div class="hs-card">
      <h3 style="font-size: 1.1rem; color: var(--hs-primary); margin-bottom: 14px;">Riwayat Tiket Anda</h3>
      <div style="font-size: 0.8125rem; color: var(--hs-text-muted); text-align: center; padding: 24px 0;">
        <i class="bi bi-shield-check" style="font-size: 2rem; color: #16A36A; display: block; margin-bottom: 8px;"></i>
        Tidak ada tiket pengaduan aktif. Seluruh pesanan Anda berjalan memuaskan.
      </div>
    </div>
  </div>
</div>
@endsection
