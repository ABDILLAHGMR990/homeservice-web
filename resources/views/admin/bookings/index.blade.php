@extends('layouts.admin')

@section('title', 'Monitoring Seluruh Pesanan - HomeService Admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
  <div>
    <h1 style="font-size: 1.75rem; color: var(--hs-primary); margin-bottom: 4px;">Monitoring Pesanan Realtime</h1>
    <p style="color: var(--hs-text-secondary); font-size: 0.9375rem;">
      Pantau kelancaran alur pemesanan seluruh pelanggan dan pergerakan teknisi di seluruh wilayah operasional.
    </p>
  </div>
</div>

<div class="hs-card" style="padding: 0; overflow: hidden;">
  <div class="hs-table-responsive" style="border: none;">
    <table class="hs-table">
      <thead>
        <tr>
          <th>Kode Order</th>
          <th>Layanan</th>
          <th>Pelanggan</th>
          <th>Mitra Teknisi</th>
          <th>Alamat Lokasi</th>
          <th>Total Tarif</th>
          <th>Komisi (10%)</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong style="color: var(--hs-primary);">HS-2026-001</strong></td>
          <td>
            <div style="font-weight: 600;">Cuci AC Split</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">1 Unit 1 PK</div>
          </td>
          <td>
            <div style="font-weight: 600;">Dian Anggraini</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">0812-3456-7890</div>
          </td>
          <td>
            <div style="font-weight: 600;">Budi Santoso</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">0812-9876-5432</div>
          </td>
          <td>Tebet Barat, Jaksel</td>
          <td>Rp 75.000</td>
          <td><strong style="color: #16A36A;">Rp 7.500</strong></td>
          <td><x-status-badge status="on_the_way" /></td>
          <td>
            <button class="hs-btn hs-btn-outline hs-btn-sm" onclick="window.showToast('Data log aktivitas pesanan dimuat.', 'info')">
              Audit Log
            </button>
          </td>
        </tr>

        <tr>
          <td><strong style="color: var(--hs-primary);">HS-2025-084</strong></td>
          <td>
            <div style="font-weight: 600;">Perbaikan Keran Bocor</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">Seal Kran Wastafel</div>
          </td>
          <td>
            <div style="font-weight: 600;">Rizky Pratama</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">0856-1122-3344</div>
          </td>
          <td>
            <div style="font-weight: 600;">Agus Wibowo</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">0813-1122-3344</div>
          </td>
          <td>Margonda, Depok</td>
          <td>Rp 50.000</td>
          <td><strong style="color: #16A36A;">Rp 5.000</strong></td>
          <td><x-status-badge status="completed" /></td>
          <td>
            <button class="hs-btn hs-btn-outline hs-btn-sm" onclick="window.showToast('Data log aktivitas pesanan dimuat.', 'info')">
              Audit Log
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
