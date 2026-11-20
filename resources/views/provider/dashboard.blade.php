@extends('layouts.provider')

@section('title', 'Dashboard Mitra Teknisi - HomeService')

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">
      Panel Kendali Mitra Teknisi
    </h1>
    <p class="page-subtitle">
      Kelola pesanan masuk, pantau jadwal kunjungan perbaikan, dan rekap pendapatan Anda.
    </p>
  </div>
  <a href="{{ route('provider.services.index') }}" class="hs-btn hs-btn-outline">
    <i class="bi bi-sliders"></i> Atur Layanan & Tarif
  </a>
</div>

<!-- 4 Statistics Cards -->
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 32px;">
  <div class="hs-card" style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
      <span style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary);">Pekerjaan Aktif</span>
      <div style="width: 36px; height: 36px; background: var(--hs-info-bg); color: var(--hs-info); border-radius: var(--hs-radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
        <i class="bi bi-wrench"></i>
      </div>
    </div>
    <div style="font-size: 1.75rem; font-weight: 700; color: var(--hs-primary); font-family: var(--hs-font-heading);">
      1
    </div>
    <div style="font-size: 0.75rem; color: #16A36A; margin-top: 4px;">
      <i class="bi bi-geo-alt-fill"></i> Sedang menuju Tebet Barat
    </div>
  </div>

  <div class="hs-card" style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
      <span style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary);">Pesanan Masuk</span>
      <div style="width: 36px; height: 36px; background: var(--hs-secondary-surface); color: #B45309; border-radius: var(--hs-radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
        <i class="bi bi-inbox-fill"></i>
      </div>
    </div>
    <div style="font-size: 1.75rem; font-weight: 700; color: var(--hs-primary); font-family: var(--hs-font-heading);">
      2 Baru
    </div>
    <div style="font-size: 0.75rem; color: #B45309; margin-top: 4px;">
      Menunggu konfirmasi Anda
    </div>
  </div>

  <div class="hs-card" style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
      <span style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary);">Pendapatan Bersih Bulan Ini</span>
      <div style="width: 36px; height: 36px; background: #E8F7F0; color: #16A36A; border-radius: var(--hs-radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
        <i class="bi bi-cash"></i>
      </div>
    </div>
    <div style="font-size: 1.75rem; font-weight: 700; color: #16A36A; font-family: var(--hs-font-heading);">
      Rp 3.420.000
    </div>
    <div style="font-size: 0.75rem; color: var(--hs-text-muted); margin-top: 4px;">
      Setelah potongan komisi 10%
    </div>
  </div>

  <div class="hs-card" style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
      <span style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary);">Rating Pelanggan</span>
      <div style="width: 36px; height: 36px; background: #FEF6E8; color: #F59E0B; border-radius: var(--hs-radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
        <i class="bi bi-star-fill"></i>
      </div>
    </div>
    <div style="font-size: 1.75rem; font-weight: 700; color: var(--hs-primary); font-family: var(--hs-font-heading);">
      4.9 <span style="font-size: 0.875rem; color: var(--hs-text-secondary); font-weight: 400;">/ 5.0</span>
    </div>
    <div style="font-size: 0.75rem; color: var(--hs-text-muted); margin-top: 4px;">
      Dari 320 ulasan pengerjaan
    </div>
  </div>
</div>

<!-- Incoming Orders Awaiting Confirmation -->
<div class="hs-card" style="margin-bottom: 32px; border: 2px solid var(--hs-secondary);">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
    <div>
      <span style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #B45309; letter-spacing: 0.05em;">Pesanan Masuk Perlu Respon</span>
      <h3 style="font-size: 1.25rem; color: var(--hs-primary); margin-top: 2px;">Pesanan Masuk Terbaru (2)</h3>
    </div>
    <span class="hs-badge hs-badge-pending">Konfirmasi Sebelum 30 Menit</span>
  </div>

  <div style="display: flex; flex-direction: column; gap: 14px;">
    <!-- Order Card 1 -->
    <div style="background: var(--hs-bg-main); border: 1px solid var(--hs-border); border-radius: var(--hs-radius-md); padding: 18px; display: flex; justify-content: space-between; align-items: center;">
      <div>
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
          <strong style="color: var(--hs-primary); font-size: 1.05rem;">Cuci AC Split (2 Unit)</strong>
          <span class="hs-badge hs-badge-neutral">Cash</span>
        </div>
        <div style="font-size: 0.8125rem; color: var(--hs-text-secondary); margin-bottom: 6px;">
          <i class="bi bi-person"></i> Pelanggan: Rahmat Hidayat • <i class="bi bi-geo-alt"></i> Pasar Minggu, Jakarta Selatan (4.2 km)
        </div>
        <div style="font-size: 0.8125rem; color: #B45309;">
          <i class="bi bi-clock"></i> Rencana Jadwal: Besok, 18 Nov 2026 (Pukul 13:00 WIB)
        </div>
      </div>

      <div id="incoming-order-actions-1" style="text-align: right; display: flex; align-items: center; gap: 12px;">
        <div style="font-size: 1.25rem; font-weight: 700; color: var(--hs-primary); font-family: var(--hs-font-heading); margin-right: 8px;">
          Rp 150.000
        </div>
        <button type="button" class="hs-btn hs-btn-outline-danger hs-btn-sm" onclick="this.parentElement.innerHTML='<span class=\'hs-badge hs-badge-rejected\'>Pesanan Ditolak</span>'; window.hsToast('Pesanan telah ditolak.', 'warning');">
          Tolak
        </button>
        <button type="button" class="hs-btn hs-btn-primary hs-btn-sm" onclick="this.parentElement.innerHTML='<span class=\'hs-badge hs-badge-accepted\'><i class=\'bi bi-check-circle-fill\'></i> Pesanan Diterima</span>'; window.hsToast('Pesanan berhasil diterima! Siapkan peralatan Anda.', 'success');">
          <i class="bi bi-check-lg"></i> Terima Pesanan
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Active Jobs & Management -->
<div class="hs-card">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h3 style="font-size: 1.15rem; color: var(--hs-primary);">Pekerjaan Berjalan Hari Ini</h3>
    <a href="{{ route('provider.bookings.index') }}" class="hs-btn hs-btn-ghost hs-btn-sm">
      Semua Riwayat <i class="bi bi-chevron-right"></i>
    </a>
  </div>

  <div class="hs-table-responsive">
    <table class="hs-table">
      <thead>
        <tr>
          <th>Kode Order</th>
          <th>Layanan</th>
          <th>Pelanggan</th>
          <th>Lokasi & Kontak</th>
          <th>Total Tarif</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong style="color: var(--hs-primary);">HS-2026-001</strong></td>
          <td>Cuci & Maintenance AC Split</td>
          <td>Dian Anggraini</td>
          <td>
            <div>Jl. Tebet Barat Dalam Raya No. 42B</div>
            <div style="font-size: 0.75rem; color: #16A36A;"><i class="bi bi-whatsapp"></i> 0812-3456-7890</div>
          </td>
          <td>Rp 75.000</td>
          <td><x-status-badge status="on_the_way" /></td>
          <td>
            <a href="{{ route('provider.bookings.show', ['booking_code' => 'HS-2026-001']) }}" class="hs-btn hs-btn-primary hs-btn-sm">
              Perbarui Status <i class="bi bi-arrow-right"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
