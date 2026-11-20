@extends('layouts.customer')

@section('title', 'Dashboard Pelanggan - HomeService')

@section('content')
<!-- Header Greeting -->
<div class="page-header">
  <div>
    <h1 class="page-title">
      Selamat Datang, {{ auth()->user()->name ?? 'Dian Anggraini' }}
    </h1>
    <p class="page-subtitle">
      Pantau status pengerjaan teknisi dan riwayat layanan rumah tangga Anda secara real-time.
    </p>
  </div>
  <a href="{{ route('public.services.index') }}" class="hs-btn hs-btn-primary">
    <i class="bi bi-calendar-plus"></i> Pesan Jasa Baru
  </a>
</div>

<!-- 4 Statistics Cards -->
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 32px;">
  <div class="hs-card" style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
      <span style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary);">Pesanan Aktif</span>
      <div style="width: 36px; height: 36px; background: var(--hs-info-bg); color: var(--hs-info); border-radius: var(--hs-radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
        <i class="bi bi-hourglass-split"></i>
      </div>
    </div>
    <div style="font-size: 1.75rem; font-weight: 700; color: var(--hs-primary); font-family: var(--hs-font-heading);">
      1
    </div>
    <div style="font-size: 0.75rem; color: #16A36A; margin-top: 4px;">
      <i class="bi bi-arrow-right"></i> Sedang menuju ke rumah Anda
    </div>
  </div>

  <div class="hs-card" style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
      <span style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary);">Pesanan Selesai</span>
      <div style="width: 36px; height: 36px; background: var(--hs-success-bg); color: var(--hs-success); border-radius: var(--hs-radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
        <i class="bi bi-check2-circle"></i>
      </div>
    </div>
    <div style="font-size: 1.75rem; font-weight: 700; color: var(--hs-primary); font-family: var(--hs-font-heading);">
      4
    </div>
    <div style="font-size: 0.75rem; color: var(--hs-text-muted); margin-top: 4px;">
      Seluruh garansi aktif
    </div>
  </div>

  <div class="hs-card" style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
      <span style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary);">Total Pengeluaran</span>
      <div style="width: 36px; height: 36px; background: var(--hs-secondary-surface); color: var(--hs-secondary); border-radius: var(--hs-radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
        <i class="bi bi-wallet2"></i>
      </div>
    </div>
    <div style="font-size: 1.75rem; font-weight: 700; color: var(--hs-primary); font-family: var(--hs-font-heading);">
      Rp 435.000
    </div>
    <div style="font-size: 0.75rem; color: var(--hs-text-muted); margin-top: 4px;">
      Pembayaran Tunai & Midtrans
    </div>
  </div>

  <div class="hs-card" style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
      <span style="font-size: 0.8125rem; font-weight: 600; color: var(--hs-text-secondary);">Alamat Tersimpan</span>
      <div style="width: 36px; height: 36px; background: var(--hs-bg-subtle); color: var(--hs-primary); border-radius: var(--hs-radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.1rem;">
        <i class="bi bi-house-door"></i>
      </div>
    </div>
    <div style="font-size: 1.75rem; font-weight: 700; color: var(--hs-primary); font-family: var(--hs-font-heading);">
      2
    </div>
    <div style="font-size: 0.75rem; color: var(--hs-text-muted); margin-top: 4px;">
      Rumah Utama & Kos
    </div>
  </div>
</div>

<!-- Active Order Progress Tracker -->
<div class="hs-card" style="margin-bottom: 32px; border-left: 4px solid var(--hs-secondary);">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
    <div>
      <span style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--hs-secondary); letter-spacing: 0.05em;">Pesanan Sedang Berjalan</span>
      <h3 style="font-size: 1.25rem; color: var(--hs-primary); margin-top: 2px;">Cuci & Maintenance AC Split (0.5 - 2 PK)</h3>
    </div>
    <x-status-badge status="on_the_way" />
  </div>

  <!-- Progress Bar Steps -->
  <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin: 24px 0;">
    <div style="border-top: 3px solid #16A36A; padding-top: 8px;">
      <div style="font-size: 0.75rem; font-weight: 700; color: #16A36A;"><i class="bi bi-check-circle-fill"></i> 1. Diterima</div>
      <div style="font-size: 0.6875rem; color: var(--hs-text-muted);">Pukul 09.15 WIB</div>
    </div>
    <div style="border-top: 3px solid var(--hs-secondary); padding-top: 8px;">
      <div style="font-size: 0.75rem; font-weight: 700; color: #B45309;"><i class="bi bi-geo-alt-fill"></i> 2. Menuju Lokasi</div>
      <div style="font-size: 0.6875rem; color: var(--hs-text-muted);">Estimasi tiba 20 mnt</div>
    </div>
    <div style="border-top: 3px solid var(--hs-border); padding-top: 8px;">
      <div style="font-size: 0.75rem; font-weight: 600; color: var(--hs-text-muted);">3. Sedang Dikerjakan</div>
      <div style="font-size: 0.6875rem; color: var(--hs-text-muted);">-</div>
    </div>
    <div style="border-top: 3px solid var(--hs-border); padding-top: 8px;">
      <div style="font-size: 0.75rem; font-weight: 600; color: var(--hs-text-muted);">4. Selesai & Garansi</div>
      <div style="font-size: 0.6875rem; color: var(--hs-text-muted);">-</div>
    </div>
  </div>

  <div style="display: flex; justify-content: space-between; align-items: center; background: var(--hs-bg-main); padding: 14px 18px; border-radius: var(--hs-radius-md);">
    <div style="display: flex; align-items: center; gap: 14px;">
      <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=120&auto=format&fit=crop" alt="Budi Santoso" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover;">
      <div>
        <div style="font-weight: 600; font-size: 0.9375rem; color: var(--hs-primary);">Teknisi: Budi Santoso</div>
        <div style="font-size: 0.75rem; color: var(--hs-text-secondary);"><i class="bi bi-telephone"></i> 0812-9876-5432 • Rating 4.9</div>
      </div>
    </div>
    <div style="display: flex; gap: 10px;">
      <a href="{{ route('customer.chat.index') }}" class="hs-btn hs-btn-outline hs-btn-sm">
        <i class="bi bi-chat-dots"></i> Chat Teknisi
      </a>
      <a href="{{ route('customer.bookings.show', ['booking_code' => 'HS-2026-001']) }}" class="hs-btn hs-btn-primary hs-btn-sm">
        Lihat Detail Order <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
</div>

<!-- Recent Booking History Table -->
<div class="hs-card">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h3 style="font-size: 1.15rem; color: var(--hs-primary);">Riwayat Pesanan Terakhir</h3>
    <a href="{{ route('customer.bookings.index') }}" class="hs-btn hs-btn-ghost hs-btn-sm">
      Semua Pesanan <i class="bi bi-chevron-right"></i>
    </a>
  </div>

  <div class="hs-table-responsive">
    <table class="hs-table">
      <thead>
        <tr>
          <th>Kode Pesanan</th>
          <th>Layanan</th>
          <th>Teknisi</th>
          <th>Jadwal Pengerjaan</th>
          <th>Total Biaya</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong style="color: var(--hs-primary);">HS-2026-001</strong></td>
          <td>Cuci & Maintenance AC Split</td>
          <td>Budi Santoso</td>
          <td>Hari Ini, 10:00 WIB</td>
          <td>Rp 75.000</td>
          <td><x-status-badge status="on_the_way" /></td>
          <td>
            <a href="{{ route('customer.bookings.show', ['booking_code' => 'HS-2026-001']) }}" class="hs-btn hs-btn-outline hs-btn-sm">Detail</a>
          </td>
        </tr>
        <tr>
          <td><strong style="color: var(--hs-primary);">HS-2025-084</strong></td>
          <td>Perbaikan Keran Bocor Wastafel</td>
          <td>Agus Wibowo</td>
          <td>12 Nov 2026</td>
          <td>Rp 50.000</td>
          <td><x-status-badge status="completed" /></td>
          <td>
            <a href="{{ route('customer.reviews.create', ['booking_code' => 'HS-2025-084']) }}" class="hs-btn hs-btn-outline hs-btn-sm">Ulasan</a>
          </td>
        </tr>
        <tr>
          <td><strong style="color: var(--hs-primary);">HS-2025-062</strong></td>
          <td>Instalasi Titik Lampu Downlight</td>
          <td>Hendra Kusuma</td>
          <td>28 Okt 2026</td>
          <td>Rp 120.000</td>
          <td><x-status-badge status="completed" /></td>
          <td>
            <a href="{{ route('customer.bookings.show', ['booking_code' => 'HS-2025-062']) }}" class="hs-btn hs-btn-outline hs-btn-sm">Detail</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
