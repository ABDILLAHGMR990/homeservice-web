@extends('layouts.app')

@section('title', 'Hubungi Kami - HomeService')

@section('content')
<div style="background-color: #FFFFFF; border-bottom: 1px solid var(--hs-border); padding: 48px 0;">
  <div class="hs-container" style="text-align: center; max-width: 760px;">
    <span style="color: var(--hs-secondary); font-weight: 700; text-transform: uppercase; font-size: 0.8125rem; letter-spacing: 0.05em;">Layanan Pelanggan</span>
    <h1 style="font-size: 2.5rem; color: var(--hs-primary); margin-top: 8px; margin-bottom: 16px;">
      Hubungi Tim HomeService
    </h1>
    <p class="hs-subtitle">
      Punya pertanyaan seputar pesanan, kemitraan teknisi, atau membutuhkan bantuan operasional? Tim kami siap melayani Anda.
    </p>
  </div>
</div>

<div class="hs-section">
  <div class="hs-container">
    <div style="display: grid; grid-template-columns: 1fr 1.2fr; gap: 48px; align-items: start;">
      <!-- Contact Information Details -->
      <div>
        <h2 style="font-size: 1.5rem; margin-bottom: 18px;">Kantor & Layanan Operasional</h2>
        <p style="color: var(--hs-text-secondary); font-size: 0.9375rem; line-height: 1.6; margin-bottom: 28px;">
          Kantor pusat kami beroperasi setiap hari Senin - Minggu untuk memantau keselamatan dan kelancaran transaksi seluruh mitra dan pelanggan.
        </p>

        <div style="display: flex; flex-direction: column; gap: 20px;">
          <div style="display: flex; gap: 16px; align-items: flex-start;">
            <div style="width: 44px; height: 44px; background: var(--hs-primary-surface); color: var(--hs-primary); border-radius: var(--hs-radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
              <i class="bi bi-geo-alt-fill"></i>
            </div>
            <div>
              <div style="font-weight: 600; color: var(--hs-primary);">Alamat Kantor Pusat</div>
              <div style="font-size: 0.875rem; color: var(--hs-text-secondary); line-height: 1.5;">One Pacific Place Lantai 15, Sudirman Central Business District (SCBD), Jakarta Selatan 12190</div>
            </div>
          </div>

          <div style="display: flex; gap: 16px; align-items: flex-start;">
            <div style="width: 44px; height: 44px; background: var(--hs-primary-surface); color: var(--hs-primary); border-radius: var(--hs-radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
              <i class="bi bi-telephone-fill"></i>
            </div>
            <div>
              <div style="font-weight: 600; color: var(--hs-primary);">Call Center (Bebas Pulsa)</div>
              <div style="font-size: 0.875rem; color: var(--hs-text-secondary); line-height: 1.5;">0800-1-HOMESERVICE (0800-1-466373)</div>
              <div style="font-size: 0.75rem; color: var(--hs-text-muted);">Pukul 07.00 - 22.00 WIB Setiap Hari</div>
            </div>
          </div>

          <div style="display: flex; gap: 16px; align-items: flex-start;">
            <div style="width: 44px; height: 44px; background: var(--hs-primary-surface); color: var(--hs-primary); border-radius: var(--hs-radius-md); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
              <i class="bi bi-envelope-fill"></i>
            </div>
            <div>
              <div style="font-weight: 600; color: var(--hs-primary);">Email Layanan Pelanggan</div>
              <div style="font-size: 0.875rem; color: var(--hs-text-secondary); line-height: 1.5;">support@homeservice.id • kemitraan@homeservice.id</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Contact Message Form -->
      <div class="hs-card" style="padding: 36px;">
        <h3 style="font-size: 1.3rem; margin-bottom: 20px;">Kirimkan Pesan atau Pertanyaan</h3>
        <form action="#" method="POST" data-loading-state>
          @csrf
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
            <div class="hs-form-group">
              <label class="hs-label">Nama Lengkap</label>
              <input type="text" class="hs-input" placeholder="Nama Anda" required>
            </div>
            <div class="hs-form-group">
              <label class="hs-label">Nomor WhatsApp</label>
              <input type="tel" class="hs-input" placeholder="08xxxxxxxxxx" required>
            </div>
          </div>

          <div class="hs-form-group">
            <label class="hs-label">Alamat Email</label>
            <input type="email" class="hs-input" placeholder="nama@email.com" required>
          </div>

          <div class="hs-form-group">
            <label class="hs-label">Topik Pertanyaan</label>
            <select class="hs-select" required>
              <option value="">Pilih Topik</option>
              <option value="pesanan">Pertanyaan Pemesanan Jasa</option>
              <option value="garansi">Klaim Garansi & Kendala Pekerjaan</option>
              <option value="mitra">Pendaftaran Mitra Teknisi</option>
              <option value="kerjasama">Kerjasama Perusahaan / B2B</option>
              <option value="lainnya">Lainnya</option>
            </select>
          </div>

          <div class="hs-form-group">
            <label class="hs-label">Pesan Anda</label>
            <textarea class="hs-textarea" placeholder="Tuliskan detail pertanyaan atau kendala yang ingin Anda sampaikan..." required></textarea>
          </div>

          <button type="submit" class="hs-btn hs-btn-primary hs-btn-lg" style="width: 100%;">
            Kirimkan Pesan <i class="bi bi-send-fill"></i>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
