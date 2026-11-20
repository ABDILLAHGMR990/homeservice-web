@extends('layouts.admin')

@section('title', 'Rekonsiliasi Pembayaran - HomeService Admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
  <div>
    <h1 style="font-size: 1.75rem; color: var(--hs-primary); margin-bottom: 4px;">Rekonsiliasi Transaksi & Pembayaran</h1>
    <p style="color: var(--hs-text-secondary); font-size: 0.9375rem;">
      Audit aliran dana Midtrans Payment Gateway, setoran komisi tunai mitra, dan settlement platform.
    </p>
  </div>
</div>

<div class="hs-card" style="padding: 0; overflow: hidden;">
  <div class="hs-table-responsive" style="border: none;">
    <table class="hs-table">
      <thead>
        <tr>
          <th>No. Transaksi</th>
          <th>Kode Pesanan</th>
          <th>Kanal Pembayaran</th>
          <th>Nominal Transaksi</th>
          <th>Bagi Hasil Mitra (90%)</th>
          <th>Komisi Platform (10%)</th>
          <th>Status Gateway</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><code>TRX-MID-20261117-001</code></td>
          <td><strong style="color: var(--hs-primary);">HS-2025-084</strong></td>
          <td><span class="hs-badge hs-badge-neutral">Midtrans (QRIS)</span></td>
          <td>Rp 50.000</td>
          <td>Rp 45.000</td>
          <td><strong style="color: #16A36A;">+ Rp 5.000</strong></td>
          <td><span class="hs-badge hs-badge-completed">Settlement</span></td>
        </tr>
        <tr>
          <td><code>TRX-CSH-20261117-002</code></td>
          <td><strong style="color: var(--hs-primary);">HS-2026-001</strong></td>
          <td><span class="hs-badge hs-badge-neutral">Tunai (Cash COD)</span></td>
          <td>Rp 75.000</td>
          <td>Rp 67.500</td>
          <td><strong style="color: #16A36A;">+ Rp 7.500</strong></td>
          <td><span class="hs-badge hs-badge-pending">Menunggu Pelunasan</span></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
