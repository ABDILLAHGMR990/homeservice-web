@extends('layouts.customer')

@section('title', 'Daftar Pesanan Saya - HomeService')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
  <div>
    <h1 style="font-size: 1.75rem; color: var(--hs-primary); margin-bottom: 4px;">Pesanan Saya</h1>
    <p style="color: var(--hs-text-secondary); font-size: 0.9375rem;">
      Kelola dan pantau seluruh transaksi pemesanan layanan rumah tangga Anda.
    </p>
  </div>
  <a href="{{ route('public.services.index') }}" class="hs-btn hs-btn-primary">
    <i class="bi bi-plus-lg"></i> Buat Pesanan Baru
  </a>
</div>

<!-- Filter Tabs -->
<div class="hs-card" style="padding: 0; overflow: hidden; margin-bottom: 24px;">
  <div style="display: flex; border-bottom: 1px solid var(--hs-border); background: var(--hs-bg-main); padding: 0 16px;">
    <a href="{{ route('customer.bookings.index') }}" style="padding: 14px 20px; font-size: 0.875rem; font-weight: 600; color: var(--hs-primary); border-bottom: 2px solid var(--hs-primary);">
      Semua Pesanan (5)
    </a>
    <a href="{{ route('customer.bookings.index', ['status' => 'active']) }}" style="padding: 14px 20px; font-size: 0.875rem; font-weight: 500; color: var(--hs-text-secondary);">
      Sedang Berjalan (1)
    </a>
    <a href="{{ route('customer.bookings.index', ['status' => 'completed']) }}" style="padding: 14px 20px; font-size: 0.875rem; font-weight: 500; color: var(--hs-text-secondary);">
      Selesai (4)
    </a>
    <a href="{{ route('customer.bookings.index', ['status' => 'cancelled']) }}" style="padding: 14px 20px; font-size: 0.875rem; font-weight: 500; color: var(--hs-text-secondary);">
      Dibatalkan (0)
    </a>
  </div>

  <div class="hs-table-responsive" style="border: none; border-radius: 0;">
    <table class="hs-table">
      <thead>
        <tr>
          <th>Kode Pesanan</th>
          <th>Layanan</th>
          <th>Teknisi</th>
          <th>Jadwal Pelaksanaan</th>
          <th>Total Tarif</th>
          <th>Metode Bayar</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Row 1: Active -->
        <tr>
          <td><strong style="color: var(--hs-primary);">HS-2026-001</strong></td>
          <td>
            <div style="font-weight: 600;">Cuci & Maintenance AC Split</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">1 Unit AC 1 PK</div>
          </td>
          <td>
            <div style="font-weight: 600;">Budi Santoso</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">0812-9876-5432</div>
          </td>
          <td>Hari Ini, 10:00 WIB</td>
          <td><strong style="color: var(--hs-primary);">Rp 75.000</strong></td>
          <td><span class="hs-badge hs-badge-neutral">Cash</span></td>
          <td><x-status-badge status="on_the_way" /></td>
          <td>
            <div style="display: flex; gap: 6px;">
              <a href="{{ route('customer.bookings.show', ['booking_code' => 'HS-2026-001']) }}" class="hs-btn hs-btn-outline hs-btn-sm">
                Lacak
              </a>
            </div>
          </td>
        </tr>

        <!-- Row 2: Completed -->
        <tr>
          <td><strong style="color: var(--hs-primary);">HS-2025-084</strong></td>
          <td>
            <div style="font-weight: 600;">Perbaikan Keran Bocor Wastafel</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">Penggantian Seal Keran</div>
          </td>
          <td>
            <div style="font-weight: 600;">Agus Wibowo</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">0813-1122-3344</div>
          </td>
          <td>12 Nov 2026</td>
          <td><strong style="color: var(--hs-primary);">Rp 50.000</strong></td>
          <td><span class="hs-badge hs-badge-neutral">Midtrans (Lunas)</span></td>
          <td><x-status-badge status="completed" /></td>
          <td>
            <div style="display: flex; gap: 6px;">
              <a href="{{ route('customer.bookings.show', ['booking_code' => 'HS-2025-084']) }}" class="hs-btn hs-btn-outline hs-btn-sm">
                Detail
              </a>
              <a href="{{ route('customer.reviews.create', ['booking_code' => 'HS-2025-084']) }}" class="hs-btn hs-btn-secondary hs-btn-sm">
                <i class="bi bi-star"></i> Ulas
              </a>
            </div>
          </td>
        </tr>

        <!-- Row 3: Completed -->
        <tr>
          <td><strong style="color: var(--hs-primary);">HS-2025-062</strong></td>
          <td>
            <div style="font-weight: 600;">Instalasi Titik Lampu Downlight</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">2 Titik Lampu Ruang Tamu</div>
          </td>
          <td>
            <div style="font-weight: 600;">Hendra Kusuma</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">0819-5566-7788</div>
          </td>
          <td>28 Okt 2026</td>
          <td><strong style="color: var(--hs-primary);">Rp 120.000</strong></td>
          <td><span class="hs-badge hs-badge-neutral">Cash</span></td>
          <td><x-status-badge status="completed" /></td>
          <td>
            <a href="{{ route('customer.bookings.show', ['booking_code' => 'HS-2025-062']) }}" class="hs-btn hs-btn-outline hs-btn-sm">
              Detail
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
