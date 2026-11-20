@extends('layouts.admin')

@section('title', 'Resolusi Pengaduan & Garansi - HomeService Admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
  <div>
    <h1 style="font-size: 1.75rem; color: var(--hs-primary); margin-bottom: 4px;">Pusat Resolusi Pengaduan & Klaim Garansi</h1>
    <p style="color: var(--hs-text-secondary); font-size: 0.9375rem;">
      Mediasi perselisihan, pengujian kelayakan klaim garansi 14 hari, dan penugasan ulang teknisi.
    </p>
  </div>
</div>

<div class="hs-card" style="padding: 0; overflow: hidden;">
  <div class="hs-table-responsive" style="border: none;">
    <table class="hs-table">
      <thead>
        <tr>
          <th>ID Tiket</th>
          <th>Kode Pesanan</th>
          <th>Pelapor (Konsumen)</th>
          <th>Mitra Terlapor</th>
          <th>Kategori Kendala</th>
          <th>Tanggal Lapor</th>
          <th>Status Tiket</th>
          <th>Aksi Mediasi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong>#TKT-2026-009</strong></td>
          <td><strong style="color: var(--hs-primary);">HS-2025-062</strong></td>
          <td>Hj. Wahyuni (BSD)</td>
          <td>Hendra Kusuma</td>
          <td>
            <div style="font-weight: 600;">Klaim Garansi 14 Hari</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">Lampu downlight berkedip setelah 5 hari</div>
          </td>
          <td>15 Nov 2026</td>
          <td><span class="hs-badge hs-badge-pending">Dalam Investigasi CS</span></td>
          <td>
            <button class="hs-btn hs-btn-primary hs-btn-sm" onclick="window.showToast('Tiket disetujui untuk kunjungan teknisi ulang bebas biaya!', 'success')">
              Setujui Garansi Ulang
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
