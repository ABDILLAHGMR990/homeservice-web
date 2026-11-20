@extends('layouts.app')

@section('title', 'Tentang HomeService - Your Home, Our Service')

@section('content')
<div style="background-color: #FFFFFF; border-bottom: 1px solid var(--hs-border); padding: 48px 0;">
  <div class="hs-container" style="text-align: center; max-width: 760px;">
    <span style="color: var(--hs-secondary); font-weight: 700; text-transform: uppercase; font-size: 0.8125rem; letter-spacing: 0.05em;">Tentang Kami</span>
    <h1 style="font-size: 2.5rem; color: var(--hs-primary); margin-top: 8px; margin-bottom: 16px;">
      Membawa Standar Profesional ke Layanan Rumah Tangga
    </h1>
    <p class="hs-subtitle">
      HomeService didirikan dengan satu misi sederhana: menghapuskan keraguan, ketidakpastian harga, dan resiko keamanan ketika memanggil teknisi ke rumah Anda.
    </p>
  </div>
</div>

<div class="hs-section">
  <div class="hs-container" style="max-width: 960px;">
    <!-- Story -->
    <div class="hs-card" style="padding: 36px; margin-bottom: 36px;">
      <h2 style="font-size: 1.5rem; margin-bottom: 16px;">Kisah & Filosofi HomeService</h2>
      <p style="color: var(--hs-text-primary); line-height: 1.8; font-size: 0.9375rem; margin-bottom: 16px;">
        Bagi kebanyakan orang, mencari tukang atau teknisi terpercaya saat AC bocor, listrik korslet, atau pipa pecah seringkali menjadi pengalaman yang melelahkan. Biaya yang tidak pasti, tukang yang tidak datang tepat waktu, hingga kekhawatiran tentang keamanan orang asing yang masuk ke dalam rumah.
      </p>
      <p style="color: var(--hs-text-primary); line-height: 1.8; font-size: 0.9375rem;">
        Di sisi lain, ribuan teknisi berbakat di Indonesia memiliki keterampilan luar biasa namun kesulitan menjangkau pelanggan secara mandiri dan sering terperangkap dalam sistem calo yang memotong pendapatan mereka secara tidak adil. HomeService hadir sebagai jembatan digital berbasis keadilan, transparansi harga, dan perlindungan hukum bagi kedua belah pihak.
      </p>
    </div>

    <!-- 3 Core Pillars -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 40px;">
      <div class="hs-card" style="text-align: center; padding: 28px 20px;">
        <div style="width: 54px; height: 54px; background: #E8F7F0; color: #16A36A; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 16px;">
          <i class="bi bi-shield-check"></i>
        </div>
        <h3 style="font-size: 1.15rem; margin-bottom: 8px;">Keamanan Teruji</h3>
        <p style="font-size: 0.8125rem; color: var(--hs-text-secondary); line-height: 1.6;">
          Verifikasi identitas KTP resmi, SKCK, dan wawancara kecakapan teknis sebelum mitra dapat menerima pesanan pertama.
        </p>
      </div>

      <div class="hs-card" style="text-align: center; padding: 28px 20px;">
        <div style="width: 54px; height: 54px; background: #FEF6E8; color: #B45309; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 16px;">
          <i class="bi bi-cash-coin"></i>
        </div>
        <h3 style="font-size: 1.15rem; margin-bottom: 8px;">Transparansi Tarif</h3>
        <p style="font-size: 0.8125rem; color: var(--hs-text-secondary); line-height: 1.6;">
          Biaya jasa dipaparkan di awal pesanan. Tidak ada pungutan tersembunyi tanpa persetujuan tertulis dari pelanggan.
        </p>
      </div>

      <div class="hs-card" style="text-align: center; padding: 28px 20px;">
        <div style="width: 54px; height: 54px; background: #EFF6FF; color: #1E40AF; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 16px;">
          <i class="bi bi-award"></i>
        </div>
        <h3 style="font-size: 1.15rem; margin-bottom: 8px;">Garansi Nyata</h3>
        <p style="font-size: 0.8125rem; color: var(--hs-text-secondary); line-height: 1.6;">
          Perlindungan pengerjaan ulang bebas biaya dalam periode garansi 14 hari bila masalah yang sama berulang kembali.
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
