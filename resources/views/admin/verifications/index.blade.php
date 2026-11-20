@extends('layouts.admin')

@section('title', 'Verifikasi Dokumen KTP Mitra - HomeService Admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
  <div>
    <h1 style="font-size: 1.75rem; color: var(--hs-primary); margin-bottom: 4px;">Verifikasi Identitas & Dokumen KTP Mitra</h1>
    <p style="color: var(--hs-text-secondary); font-size: 0.9375rem;">
      Tinjau keabsahan berkas identitas calon mitra teknisi untuk memastikan keamanan seluruh pengguna.
    </p>
  </div>
</div>

<div class="hs-card" style="padding: 0; overflow: hidden;">
  <div style="display: flex; border-bottom: 1px solid var(--hs-border); background: var(--hs-bg-main); padding: 0 16px;">
    <a href="#" style="padding: 14px 20px; font-size: 0.875rem; font-weight: 600; color: var(--hs-primary); border-bottom: 2px solid var(--hs-primary);">
      Menunggu Verifikasi (3)
    </a>
    <a href="#" style="padding: 14px 20px; font-size: 0.875rem; font-weight: 500; color: var(--hs-text-secondary);">
      Telah Disetujui (328)
    </a>
    <a href="#" style="padding: 14px 20px; font-size: 0.875rem; font-weight: 500; color: var(--hs-text-secondary);">
      Ditolak (14)
    </a>
  </div>

  <div class="hs-table-responsive" style="border: none;">
    <table class="hs-table">
      <thead>
        <tr>
          <th>Nama Calon Mitra</th>
          <th>Nomor NIK KTP</th>
          <th>Keahlian & Pengalaman</th>
          <th>Wilayah Domisili</th>
          <th>Dokumen Berkas</th>
          <th>Tanggal Pengajuan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div style="font-weight: 700; color: var(--hs-primary);">Bambang Hermanto</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">0812-9988-7766 • bambang@gmail.com</div>
          </td>
          <td><code>3171020409850002</code></td>
          <td>
            <div style="font-weight: 600;">Plumbing & Pipa Air</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">Pengalaman 6 Tahun</div>
          </td>
          <td>Jakarta Barat</td>
          <td>
            <div style="display: flex; flex-direction: column; gap: 4px; font-size: 0.75rem;">
              <span style="color: #2563EB; font-weight: 600;"><i class="bi bi-file-earmark-person"></i> ktp_bambang.jpg</span>
              <span style="color: #2563EB; font-weight: 600;"><i class="bi bi-file-earmark-check"></i> sertifikat_plumbing.pdf</span>
            </div>
          </td>
          <td>16 Nov 2026, 14:20</td>
          <td>
            <div style="display: flex; gap: 6px;">
              <button type="button" class="hs-btn hs-btn-primary hs-btn-sm" onclick="this.parentElement.innerHTML='<span class=\'hs-badge hs-badge-completed\'><i class=\'bi bi-patch-check-fill\'></i> Terverifikasi</span>'; window.showToast('Mitra Bambang Hermanto berhasil disetujui!', 'success')">
                <i class="bi bi-check-lg"></i> Setujui
              </button>
              <button type="button" class="hs-btn hs-btn-outline-danger hs-btn-sm" onclick="this.parentElement.innerHTML='<span class=\'hs-badge hs-badge-rejected\'>Ditolak</span>'; window.showToast('Berkas Bambang Hermanto ditolak.', 'warning')">
                Tolak
              </button>
            </div>
          </td>
        </tr>

        <tr>
          <td>
            <div style="font-weight: 700; color: var(--hs-primary);">Rian Gunawan</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">0819-2233-4455 • rian.g@gmail.com</div>
          </td>
          <td><code>3276011503920005</code></td>
          <td>
            <div style="font-weight: 600;">Perbaikan Elektronik</div>
            <div style="font-size: 0.75rem; color: var(--hs-text-secondary);">Pengalaman 4 Tahun</div>
          </td>
          <td>Depok, Jawa Barat</td>
          <td>
            <div style="display: flex; flex-direction: column; gap: 4px; font-size: 0.75rem;">
              <span style="color: #2563EB; font-weight: 600;"><i class="bi bi-file-earmark-person"></i> ktp_rian_depok.jpg</span>
            </div>
          </td>
          <td>16 Nov 2026, 18:05</td>
          <td>
            <div style="display: flex; gap: 6px;">
              <button type="button" class="hs-btn hs-btn-primary hs-btn-sm" onclick="this.parentElement.innerHTML='<span class=\'hs-badge hs-badge-completed\'><i class=\'bi bi-patch-check-fill\'></i> Terverifikasi</span>'; window.showToast('Mitra Rian Gunawan berhasil disetujui!', 'success')">
                <i class="bi bi-check-lg"></i> Setujui
              </button>
              <button type="button" class="hs-btn hs-btn-outline-danger hs-btn-sm" onclick="this.parentElement.innerHTML='<span class=\'hs-badge hs-badge-rejected\'>Ditolak</span>'; window.showToast('Berkas Rian Gunawan ditolak.', 'warning')">
                Tolak
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
