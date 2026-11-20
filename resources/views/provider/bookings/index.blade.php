@extends('layouts.provider')

@section('title', 'Manajemen Pekerjaan & Pesanan - HomeService')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
  <div>
    <h1 style="font-size: 1.75rem; color: var(--hs-primary); margin-bottom: 4px;">Daftar Pekerjaan & Order Masuk</h1>
    <p style="color: var(--hs-text-secondary); font-size: 0.9375rem;">
      Pantau pesanan yang masuk, perbarui status pengerjaan, dan lihat arsip pekerjaan selesai.
    </p>
  </div>
</div>

<!-- Tabs -->
<div class="hs-card" style="padding: 0; overflow: hidden; margin-bottom: 24px;">
  <div style="display: flex; border-bottom: 1px solid var(--hs-border); background: var(--hs-bg-main); padding: 0 16px;">
    <a href="{{ route('provider.bookings.index') }}" style="padding: 14px 20px; font-size: 0.875rem; font-weight: 600; color: var(--hs-primary); border-bottom: 2px solid var(--hs-primary);">
      Semua (6)
    </a>
    <a href="{{ route('provider.bookings.index', ['status' => 'pending']) }}" style="padding: 14px 20px; font-size: 0.875rem; font-weight: 500; color: var(--hs-text-secondary);">
      Order Masuk (2)
    </a>
    <a href="{{ route('provider.bookings.index', ['status' => 'in_progress']) }}" style="padding: 14px 20px; font-size: 0.875rem; font-weight: 500; color: var(--hs-text-secondary);">
      Sedang Dikerjakan (1)
    </a>
    <a href="{{ route('provider.bookings.index', ['status' => 'completed']) }}" style="padding: 14px 20px; font-size: 0.875rem; font-weight: 500; color: var(--hs-text-secondary);">
      Selesai (3)
    </a>
  </div>

  <div class="hs-table-responsive" style="border: none; border-radius: 0;">
    <table class="hs-table">
      <thead>
        <tr>
          <th>Kode Pesanan</th>
          <th>Layanan</th>
          <th>Nama Pelanggan</th>
          <th>Jadwal Pelaksanaan</th>
          <th>Pendapatan Bersih</th>
          <th>Metode Bayar</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Active Job -->
        <tr>
          <td><strong style="color: var(--hs-primary);">HS-2026-001</strong></td>
          <td>
            <div style="font-weight: 600;">Cuci & Maintenance AC Split</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">1 Unit AC Daikin 1 PK</div>
          </td>
          <td>
            <div style="font-weight: 600;">Dian Anggraini</div>
            <div style="font-size: 0.75rem; color: #16A36A;"><i class="bi bi-whatsapp"></i> 0812-3456-7890</div>
          </td>
          <td>Hari Ini, 10:00 WIB</td>
          <td>
            <strong style="color: #16A36A;">Rp 67.500</strong>
            <div style="font-size: 0.6875rem; color: var(--hs-text-muted);">Gross: Rp 75.000</div>
          </td>
          <td><span class="hs-badge hs-badge-neutral">Cash</span></td>
          <td><x-status-badge status="on_the_way" /></td>
          <td>
            <a href="{{ route('provider.bookings.show', ['booking_code' => 'HS-2026-001']) }}" class="hs-btn hs-btn-primary hs-btn-sm">
              Proses Order
            </a>
          </td>
        </tr>

        <!-- Completed Job -->
        <tr>
          <td><strong style="color: var(--hs-primary);">HS-2025-077</strong></td>
          <td>
            <div style="font-weight: 600;">Isi Ulang Freon R32</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">1 Unit AC Sharp</div>
          </td>
          <td>
            <div style="font-weight: 600;">Ferry Kurniawan</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">0857-1122-9988</div>
          </td>
          <td>14 Nov 2026</td>
          <td>
            <strong style="color: #16A36A;">Rp 135.000</strong>
            <div style="font-size: 0.6875rem; color: var(--hs-text-muted);">Gross: Rp 150.000</div>
          </td>
          <td><span class="hs-badge hs-badge-neutral">Midtrans</span></td>
          <td><x-status-badge status="completed" /></td>
          <td>
            <a href="{{ route('provider.bookings.show', ['booking_code' => 'HS-2025-077']) }}" class="hs-btn hs-btn-outline hs-btn-sm">
              Rincian
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
