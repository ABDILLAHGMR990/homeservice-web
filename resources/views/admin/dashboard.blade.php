@extends('layouts.admin')

@section('title', 'Executive Statistics - HomeService Admin')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Ringkasan Operasional Platform</h1>
    <p class="page-subtitle">
      Pemantauan metrik transaksi, pertumbuhan mitra teknisi, dan resolusi layanan seluruh wilayah.
    </p>
  </div>
  <div style="display: flex; gap: 10px;">
    <a href="{{ route('admin.verifications.index') }}" class="hs-btn hs-btn-outline hs-btn-sm">
      <i class="bi bi-patch-check"></i> Verifikasi KTP
    </a>
    <a href="{{ route('admin.users.index') }}" class="hs-btn hs-btn-primary hs-btn-sm">
      <i class="bi bi-person-plus-fill"></i> Kelola & Tambah Teknisi
    </a>
  </div>
</div>

<!-- 5 Statistics Key Metric Cards -->
<div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 18px; margin-bottom: 32px;">
  <div class="hs-card" style="padding: 20px;">
    <div style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary); margin-bottom: 6px;">Total Pengguna</div>
    <div style="font-size: 1.75rem; font-weight: 700; color: var(--hs-primary); font-family: var(--hs-font-heading);">
      1.240
    </div>
    <div style="font-size: 0.75rem; color: #16A36A; margin-top: 4px;">
      <i class="bi bi-arrow-up-short"></i> +12% bulan ini
    </div>
  </div>

  <div class="hs-card" style="padding: 20px;">
    <div style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary); margin-bottom: 6px;">Teknisi Terverifikasi</div>
    <div style="font-size: 1.75rem; font-weight: 700; color: var(--hs-primary); font-family: var(--hs-font-heading);">
      328
    </div>
    <div style="font-size: 0.75rem; color: #16A36A; margin-top: 4px;">
      Aktif melayani di Jabodetabek
    </div>
  </div>

  <div class="hs-card" style="padding: 20px; border-left: 3px solid var(--hs-secondary);">
    <div style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary); margin-bottom: 6px;">Antrean KTP Mitra</div>
    <div style="font-size: 1.75rem; font-weight: 700; color: #B45309; font-family: var(--hs-font-heading);">
      3 Menunggu
    </div>
    <div style="font-size: 0.75rem; color: #B45309; margin-top: 4px;">
      Perlu ditinjau hari ini
    </div>
  </div>

  <div class="hs-card" style="padding: 20px;">
    <div style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary); margin-bottom: 6px;">Total GMV Transaksi</div>
    <div style="font-size: 1.75rem; font-weight: 700; color: var(--hs-primary); font-family: var(--hs-font-heading);">
      Rp 84.500.000
    </div>
    <div style="font-size: 0.75rem; color: var(--hs-text-muted); margin-top: 4px;">
      Nilai transaksi kotor
    </div>
  </div>

  <div class="hs-card" style="padding: 20px; border-left: 3px solid #16A36A;">
    <div style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary); margin-bottom: 6px;">Pendapatan Komisi (10%)</div>
    <div style="font-size: 1.75rem; font-weight: 700; color: #16A36A; font-family: var(--hs-font-heading);">
      Rp 8.450.000
    </div>
    <div style="font-size: 0.75rem; color: #16A36A; margin-top: 4px;">
      Pendapatan bersih platform
    </div>
  </div>
</div>

<!-- Urgent Verifications Table -->
<div class="hs-card" style="margin-bottom: 32px;">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
    <div>
      <h3 style="font-size: 1.15rem; color: var(--hs-primary);">Antrean Verifikasi KTP & Keahlian Calon Mitra</h3>
      <p style="font-size: 0.8125rem; color: var(--hs-text-secondary);">Tinjau keaslian dokumen sebelum teknisi diizinkan menerima pesanan konsumen.</p>
    </div>
    <a href="{{ route('admin.verifications.index') }}" class="hs-btn hs-btn-outline hs-btn-sm">
      Kelola Semua Verifikasi <i class="bi bi-chevron-right"></i>
    </a>
  </div>

  <div class="hs-table-responsive">
    <table class="hs-table">
      <thead>
        <tr>
          <th>Nama Teknisi</th>
          <th>Keahlian Utama</th>
          <th>Nomor NIK KTP</th>
          <th>Pengalaman</th>
          <th>Wilayah Tugas</th>
          <th>Tanggal Pengajuan</th>
          <th>Aksi Verifikasi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div style="font-weight: 700; color: var(--hs-primary);">Bambang Hermanto</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">0812-9988-7766</div>
          </td>
          <td><span class="hs-badge hs-badge-neutral">Plumbing & Pipa Air</span></td>
          <td>3171020409850002</td>
          <td>6 Tahun</td>
          <td>Jakarta Barat</td>
          <td>16 Nov 2026</td>
          <td>
            <div style="display: flex; gap: 6px;">
              <button type="button" class="hs-btn hs-btn-primary hs-btn-sm" onclick="this.parentElement.innerHTML='<span class=\'hs-badge hs-badge-completed\'><i class=\'bi bi-patch-check-fill\'></i> Disetujui</span>'; window.hsToast('Verifikasi KTP Bambang Hermanto berhasil disetujui!', 'success');">
                <i class="bi bi-check-lg"></i> Setujui
              </button>
              <button type="button" class="hs-btn hs-btn-outline-danger hs-btn-sm" onclick="this.parentElement.innerHTML='<span class=\'hs-badge hs-badge-rejected\'>Ditolak</span>'; window.hsToast('Pengajuan verifikasi ditolak.', 'warning');">
                Tolak
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Realtime Live Orders Monitoring Feed -->
<div class="hs-card">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
    <h3 style="font-size: 1.15rem; color: var(--hs-primary);">Monitoring Seluruh Pesanan Realtime</h3>
    <a href="{{ route('admin.bookings.index') }}" class="hs-btn hs-btn-ghost hs-btn-sm">
      Buka Panel Monitoring <i class="bi bi-chevron-right"></i>
    </a>
  </div>

  <div class="hs-table-responsive">
    <table class="hs-table">
      <thead>
        <tr>
          <th>Kode Pesanan</th>
          <th>Layanan</th>
          <th>Pelanggan</th>
          <th>Mitra Bertugas</th>
          <th>Total Tarif</th>
          <th>Komisi Platform (10%)</th>
          <th>Status Saat Ini</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong style="color: var(--hs-primary);">HS-2026-001</strong></td>
          <td>Cuci & Maintenance AC Split</td>
          <td>Dian Anggraini (Jaksel)</td>
          <td>Budi Santoso</td>
          <td>Rp 75.000</td>
          <td><strong style="color: #16A36A;">Rp 7.500</strong></td>
          <td><x-status-badge status="on_the_way" /></td>
        </tr>
        <tr>
          <td><strong style="color: var(--hs-primary);">HS-2025-084</strong></td>
          <td>Perbaikan Keran Bocor Wastafel</td>
          <td>Rizky Pratama (Depok)</td>
          <td>Agus Wibowo</td>
          <td>Rp 50.000</td>
          <td><strong style="color: #16A36A;">Rp 5.000</strong></td>
          <td><x-status-badge status="completed" /></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
