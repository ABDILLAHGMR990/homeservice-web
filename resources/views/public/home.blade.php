@extends('layouts.app')

@section('title', 'HomeService - Solusi Perbaikan & Jasa Rumah Tangga Terpercaya')

@section('content')
<!-- =========================================================================
     1. CRYSTAL-CLEAR ARCHITECTURAL HERO SECTION (FOTO 3 UPGRADE)
     ========================================================================= -->
<section class="vl-hero">
  <!-- Crystal-Clear High-Definition Background Image + Directional Scrim -->
  <div class="vl-hero-bg-layer" aria-hidden="true"></div>
  <div class="vl-hero-scrim" aria-hidden="true"></div>
  <div class="vl-hero-light-beam" aria-hidden="true"></div>

  <div class="hs-container">
    <div class="row g-4 align-items-center">
      <!-- Left Column: Staggered Editorial Typography & Animated Search -->
      <div class="col-lg-7">
        <div class="vl-editorial-kicker vl-hero-enter" style="--enter-delay: 40ms;">
          <span class="vl-editorial-kicker-line"></span>
          <span>YOUR HOME, OUR SERVICE</span>
          <span class="vl-editorial-kicker-sep">/</span>
          <span class="vl-editorial-kicker-accent">STANDAR TEKNISI RESMI</span>
        </div>

        <h1 class="vl-hero-title">
          <span class="d-block vl-hero-enter" style="--enter-delay: 110ms;">Solusi Masalah Rumah.</span>
          <span class="d-block vl-hero-enter" style="--enter-delay: 190ms;"><em>Rawat &amp; Perbaiki</em></span>
          <span class="d-block vl-hero-enter" style="--enter-delay: 270ms;"><strong>Setiap Ruangan.</strong></span>
        </h1>

        <p class="vl-hero-enter" style="--enter-delay: 340ms; font-size: 1.02rem; color: #E2E8F0; line-height: 1.68; max-width: 540px; margin-bottom: 28px;">
          Layanan <strong>teknisi AC, instalasi listrik, plumbing, hingga deep cleaning</strong> dengan standar pengerjaan rapi, harga transparan, dan garansi resmi 14 hari.
        </p>

        <!-- Dual CTA Buttons -->
        <div class="vl-hero-enter" style="--enter-delay: 410ms; display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 26px;">
          <a href="{{ route('public.services.index') }}" class="hs-btn vl-btn-amber hs-btn-lg">
            Pesan Layanan Sekarang <i class="bi bi-arrow-right"></i>
          </a>
          <a href="{{ route('public.how-it-works') }}" class="hs-btn hs-btn-outline-light hs-btn-lg">
            Konsultasi &amp; Cara Kerja
          </a>
        </div>

        <!-- Integrated Glass Search Bar with Cycling Placeholder -->
        <form action="{{ route('public.services.index') }}" method="GET" class="vl-hero-search-form vl-hero-enter" style="--enter-delay: 480ms;">
          <i class="bi bi-search" style="font-size: 1.1rem; color: #FACC15; flex-shrink: 0;"></i>
          <input type="text" id="hero-search-input" name="q" class="vl-hero-search-input" placeholder="Cari layanan: Cuci AC Split 1 PK..." aria-label="Cari Jasa">
          <button type="submit" class="hs-btn vl-btn-amber hs-btn-sm" style="padding: 10px 20px;">
            Cari Jasa
          </button>
        </form>
      </div>

      <!-- Right Column: Interactive Architectural Credential Panel -->
      <div class="col-lg-5 d-flex justify-content-lg-end">
        <div class="vl-hero-spec-panel" id="vl-hero-spec-panel" style="width: 100%; max-width: 360px;">
          <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; padding-bottom: 10px; border-bottom: 1px solid rgba(255,255,255,0.12);">
            <span class="hs-font-mono" style="font-size: 0.7rem; font-weight: 600; color: #FACC15; letter-spacing: 0.08em;">STANDAR OPERASIONAL</span>
            <span class="hs-font-mono" style="font-size: 0.7rem; color: #94A3B8;">JABODETABEK</span>
          </div>

          <div style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px;">
            <div class="vl-spec-row">
              <i class="bi bi-patch-check-fill" style="color: #FACC15; font-size: 1rem; margin-top: 2px; flex-shrink: 0;"></i>
              <div>
                <div style="font-size: 0.875rem; font-weight: 700; color: #FFFFFF;">320+ Teknisi Terverifikasi KTP</div>
                <div style="font-size: 0.75rem; color: #CBD5E1; line-height: 1.45;">Seleksi identitas resmi &amp; uji kompetensi teknis.</div>
              </div>
            </div>

            <div class="vl-spec-row">
              <i class="bi bi-shield-fill-check" style="color: #10B981; font-size: 1rem; margin-top: 2px; flex-shrink: 0;"></i>
              <div>
                <div style="font-size: 0.875rem; font-weight: 700; color: #FFFFFF;">Garansi Pengerjaan 14 Hari</div>
                <div style="font-size: 0.75rem; color: #CBD5E1; line-height: 1.45;">Perbaikan ulang 100% gratis bila kendala berulang.</div>
              </div>
            </div>

            <div class="vl-spec-row">
              <i class="bi bi-receipt" style="color: #38BDF8; font-size: 1rem; margin-top: 2px; flex-shrink: 0;"></i>
              <div>
                <div style="font-size: 0.875rem; font-weight: 700; color: #FFFFFF;">Tarif Transparan di Awal</div>
                <div style="font-size: 0.75rem; color: #CBD5E1; line-height: 1.45;">Mendukung Tunai, QRIS, &amp; Virtual Account.</div>
              </div>
            </div>
          </div>

          <div style="padding-top: 12px; border-top: 1px solid rgba(255,255,255,0.10); display: flex; justify-content: space-between; align-items: center;">
            <span style="font-size: 0.72rem; color: #94A3B8;">Buka 07.00 – 21.00 WIB</span>
            <a href="{{ route('public.technicians.index') }}" style="font-size: 0.75rem; font-weight: 700; color: #FACC15; display: inline-flex; align-items: center; gap: 5px;">
              Lihat Teknisi <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bottom Hero 3-Column Animated Stats Bar -->
    <div class="vl-hero-stats-bar vl-hero-enter" style="--enter-delay: 520ms;">
      <div class="vl-hero-stats-grid">
        <div class="vl-hero-stat-item" style="border-right: 1px solid rgba(255,255,255,0.14);">
          <div class="vl-hero-stat-num" data-countup="15000" data-suffix="+">15.000+</div>
          <div class="vl-hero-stat-label">Pekerjaan Selesai Tuntas</div>
        </div>
        <div class="vl-hero-stat-item" style="border-right: 1px solid rgba(255,255,255,0.14);">
          <div class="vl-hero-stat-num" data-countup="4.9" data-decimals="1" data-suffix=" / 5.0">4.9 / 5.0</div>
          <div class="vl-hero-stat-label">Rata-rata Rating Pelanggan</div>
        </div>
        <div class="vl-hero-stat-item">
          <div class="vl-hero-stat-num" data-countup="320" data-suffix="+">320+</div>
          <div class="vl-hero-stat-label">Teknisi Terverifikasi KTP Resmi</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     2. ARCHITECTURAL BENTO & 3-PILLAR STANDARDS (FOTO 1 UPGRADE — ZERO AI SLOP)
     ========================================================================= -->
<section class="hs-section" style="background-color: #FFFFFF; border-bottom: 1px solid var(--hs-border);">
  <div class="hs-container">
    <div class="row g-5 align-items-center">
      <!-- Left: High-Res Modern Interior + Overlapping SOP Protocol Card -->
      <div class="col-lg-5">
        <div class="vl-about-gallery">
          <div class="vl-about-main-img">
            <img src="https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?q=85&w=1000&auto=format&fit=crop" alt="Hunian Modern Bersih & Terawat">
          </div>

          <!-- Overlapping Architectural SOP Card -->
          <div class="vl-about-sop-card">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; padding-bottom: 10px; border-bottom: 1px solid rgba(255,255,255,0.12);">
              <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: #FACC15;">Protokol Kerja Resmi</span>
              <span class="hs-badge hs-badge-success" style="font-size: 0.68rem;">SOP v2.4</span>
            </div>
            <div style="display: flex; flex-direction: column; gap: 8px; font-size: 0.8125rem; color: #E2E8F0;">
              <div style="display: flex; align-items: center; gap: 8px;">
                <i class="bi bi-check2-circle" style="color: #FACC15;"></i>
                <span>Inspeksi Alat &amp; Estimasi Transparan</span>
              </div>
              <div style="display: flex; align-items: center; gap: 8px;">
                <i class="bi bi-check2-circle" style="color: #FACC15;"></i>
                <span>Pelindung Kebersihan Area Kerja</span>
              </div>
              <div style="display: flex; align-items: center; gap: 8px;">
                <i class="bi bi-check2-circle" style="color: #FACC15;"></i>
                <span>Berita Acara &amp; Garansi 14 Hari</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right: Editorial Content + 3 Interactive Pillar Cards + Action Bar -->
      <div class="col-lg-7">
        <div class="vl-editorial-kicker" style="color: var(--hs-text-secondary); margin-bottom: 12px;">
          <span class="vl-editorial-kicker-line" style="background-color: var(--hs-primary);"></span>
          <span>STANDAR LAYANAN KAMI</span>
        </div>

        <h2 class="vl-heading" style="margin-bottom: 16px;">
          Meningkatkan <span class="vl-muted">Kenyamanan Hunian</span><br>
          melalui <strong>Keahlian, Keamanan &amp; Garansi</strong>
        </h2>

        <p style="font-size: 0.9375rem; color: var(--hs-text-secondary); line-height: 1.7; margin-bottom: 28px;">
          Setiap teknisi <strong style="color: var(--hs-primary);">HomeService</strong> melewati proses kurasi ketat agar setiap perbaikan di rumah Anda berjalan rapi, tepat waktu, dengan biaya yang disepakati di muka tanpa kejutan tambahan.
        </p>

        <!-- 3 Interactive Architectural Pillar Cards -->
        <div class="vl-pillar-grid">
          <div class="vl-pillar-card">
            <div class="vl-pillar-icon">
              <i class="bi bi-person-badge-fill"></i>
            </div>
            <div style="font-size: 0.9375rem; font-weight: 700; color: var(--hs-primary); margin-bottom: 4px;">Verifikasi KTP &amp; Keahlian</div>
            <div style="font-size: 0.78125rem; color: var(--hs-text-secondary); line-height: 1.5;">
              Seluruh mitra terdaftar resmi dengan identitas KTP aktif dan rekam jejak teruji.
            </div>
          </div>

          <div class="vl-pillar-card">
            <div class="vl-pillar-icon">
              <i class="bi bi-receipt-cutoff"></i>
            </div>
            <div style="font-size: 0.9375rem; font-weight: 700; color: var(--hs-primary); margin-bottom: 4px;">Harga Baku di Awal</div>
            <div style="font-size: 0.78125rem; color: var(--hs-text-secondary); line-height: 1.5;">
              Rincian biaya jasa tertera jelas sebelum pemesanan dikonfirmasi.
            </div>
          </div>

          <div class="vl-pillar-card">
            <div class="vl-pillar-icon">
              <i class="bi bi-shield-check"></i>
            </div>
            <div style="font-size: 0.9375rem; font-weight: 700; color: var(--hs-primary); margin-bottom: 4px;">Garansi Penuh 14 Hari</div>
            <div style="font-size: 0.78125rem; color: var(--hs-text-secondary); line-height: 1.5;">
              Jaminan kunjungan perbaikan ulang gratis jika kendala yang sama berulang.
            </div>
          </div>
        </div>

        <!-- Clean Bottom CTA & Rating Bar -->
        <div style="display: flex; align-items: center; justify-content: space-between; gap: 20px; padding-top: 22px; border-top: 1px solid var(--hs-border); flex-wrap: wrap;">
          <div style="display: flex; align-items: center; gap: 14px;">
            <a href="{{ route('public.about') }}" class="hs-btn hs-btn-primary">
              Pelajari Standar Kami <i class="bi bi-arrow-right"></i>
            </a>
            <a href="{{ route('public.technicians.index') }}" class="hs-btn hs-btn-outline">
              Lihat Direktori Teknisi
            </a>
          </div>

          <div style="display: flex; align-items: center; gap: 10px; background: var(--hs-bg-main); border: 1px solid var(--hs-border); padding: 8px 14px; border-radius: 10px;">
            <i class="bi bi-star-fill" style="color: #F59E0B; font-size: 1rem;"></i>
            <div>
              <div class="hs-tabular" style="font-size: 0.8125rem; font-weight: 800; color: var(--hs-primary); line-height: 1.1;">4.9 / 5.0 Rating</div>
              <div style="font-size: 0.7rem; color: var(--hs-text-secondary);">Dari 15.000+ pekerjaan</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     3. "CRAFTED FOR EVERY STYLE" — 3-CARD SHOWCASE (WHITE - DARK - WHITE)
        + 10 KATEGORI LAYANAN RUMAH TANGGA
     ========================================================================= -->
<section class="hs-section" style="background-color: #FFFFFF;">
  <div class="hs-container">
    <!-- Centered Editorial Heading -->
    <div style="text-align: center; max-width: 640px; margin: 0 auto 44px auto;">
      <span class="vl-eyebrow">Spesialisasi & Kategori</span>
      <h2 class="vl-heading" style="margin-bottom: 12px;">
        Dirancang untuk <strong>Setiap Kebutuhan Rumah</strong>
      </h2>
      <p style="font-size: 0.9375rem; color: var(--hs-text-secondary);">
        Kami menghadirkan solusi perawatan dan perbaikan rumah yang <strong>didukung ratusan teknisi bersertifikat</strong> untuk hasil terbaik di setiap proyek.
      </p>
    </div>

    <!-- 3-Column Showcase Grid (Exact Match to VistaLux Top-Right) -->
    <div class="vl-showcase-grid" style="margin-bottom: 52px;">
      <!-- Left White Card -->
      <div class="vl-showcase-card-light">
        <div style="height: 220px; border-radius: 14px; overflow: hidden; margin-bottom: 20px;">
          <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?q=80&w=600&auto=format&fit=crop" alt="Service AC & Pendingin" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div style="padding: 0 8px; flex-grow: 1; display: flex; flex-direction: column;">
          <h3 style="font-size: 1.15rem; font-weight: 800; color: var(--hs-primary); margin-bottom: 8px;">Service AC & Tata Udara</h3>
          <p style="font-size: 0.84375rem; color: var(--hs-text-secondary); line-height: 1.6; margin-bottom: 16px; flex-grow: 1;">
            Cuci AC split, pengisian freon R32/R410a, bongkar pasang unit, hingga perbaikan kompresor dengan tekanan terukur.
          </p>
          <a href="{{ route('public.services.index', ['category' => 'service-ac']) }}" style="font-size: 0.8125rem; font-weight: 700; color: var(--hs-primary); display: inline-flex; align-items: center; gap: 6px;">
            Lihat Layanan AC <i class="bi bi-arrow-up-right"></i>
          </a>
        </div>
      </div>

      <!-- Center Inverted Dark Card with Yellow Square Corner Button -->
      <div class="vl-showcase-card-dark">
        <div>
          <span style="display: inline-block; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: #FACC15; margin-bottom: 10px;">Prioritas & Darurat</span>
          <h3 style="font-size: 1.35rem; font-weight: 800; color: #FFFFFF; margin-bottom: 12px;">Instalasi & Perbaikan Listrik</h3>
          <p style="font-size: 0.84375rem; color: #CBD5E1; line-height: 1.65; margin-bottom: 24px;">
            Penanganan korsleting listrik, perakitan panel MCB, pemasangan lampu gantung & titik saklar baru berstandar keselamatan PUIL.
          </p>

          <div style="display: flex; flex-direction: column; gap: 12px; font-size: 0.84375rem; color: #F8FAFC;">
            <div style="display: flex; align-items: center; gap: 10px;">
              <i class="bi bi-check-circle" style="color: #FACC15;"></i>
              <span>Pengecekan Grounding & Beban MCB</span>
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
              <i class="bi bi-check-circle" style="color: #FACC15;"></i>
              <span>Teknisi Bersertifikat K3 Kelistrikan</span>
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
              <i class="bi bi-check-circle" style="color: #FACC15;"></i>
              <span>Garansi Instalasi Resmi 14 Hari</span>
            </div>
          </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 28px; padding-top: 18px; border-top: 1px solid rgba(255,255,255,0.12);">
          <div>
            <div style="font-size: 0.72rem; color: #94A3B8;">Tarif Mulai Dari</div>
            <div class="hs-tabular" style="font-size: 1.2rem; font-weight: 800; color: #FFFFFF;">Rp 60.000 <span style="font-size: 0.75rem; font-weight: 400; color: #94A3B8;">/ titik</span></div>
          </div>
          <a href="{{ route('public.services.index', ['category' => 'instalasi-listrik']) }}" class="vl-corner-btn-amber" title="Lihat Layanan Listrik">
            <i class="bi bi-arrow-up-right"></i>
          </a>
        </div>
      </div>

      <!-- Right White Card -->
      <div class="vl-showcase-card-light">
        <div style="height: 220px; border-radius: 14px; overflow: hidden; margin-bottom: 20px;">
          <img src="https://images.unsplash.com/photo-1585704032915-c3400ca199e7?q=80&w=600&auto=format&fit=crop" alt="Plumbing & Deep Cleaning" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div style="padding: 0 8px; flex-grow: 1; display: flex; flex-direction: column;">
          <h3 style="font-size: 1.15rem; font-weight: 800; color: var(--hs-primary); margin-bottom: 8px;">Plumbing & Deep Cleaning</h3>
          <p style="font-size: 0.84375rem; color: var(--hs-text-secondary); line-height: 1.6; margin-bottom: 16px; flex-grow: 1;">
            Perbaikan pipa bocor, pelancaran saluran mampet, servis pompa air, hingga pembersihan menyeluruh pasca renovasi.
          </p>
          <a href="{{ route('public.services.index', ['category' => 'plumbing']) }}" style="font-size: 0.8125rem; font-weight: 700; color: var(--hs-primary); display: inline-flex; align-items: center; gap: 6px;">
            Lihat Layanan Plumbing <i class="bi bi-arrow-up-right"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- All 10 Categories Interactive Grid -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <div style="font-size: 0.875rem; font-weight: 700; color: var(--hs-primary);">
        Jelajahi Seluruh 10 Kategori Layanan Rumah Tangga:
      </div>
      <a href="{{ route('public.categories.index') }}" class="hs-btn hs-btn-outline hs-btn-sm">
        Semua Kategori <i class="bi bi-chevron-right"></i>
      </a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 14px;">
      @php
        $categoriesList = [
          ['name' => 'Service AC', 'slug' => 'service-ac', 'icon' => 'bi-snow', 'count' => '42 Teknisi'],
          ['name' => 'Instalasi Listrik', 'slug' => 'instalasi-listrik', 'icon' => 'bi-lightning-charge', 'count' => '38 Teknisi'],
          ['name' => 'Perbaikan Listrik', 'slug' => 'perbaikan-listrik', 'icon' => 'bi-plug', 'count' => '29 Teknisi'],
          ['name' => 'Plumbing & Air', 'slug' => 'plumbing', 'icon' => 'bi-droplet-half', 'count' => '35 Teknisi'],
          ['name' => 'Cleaning Service', 'slug' => 'cleaning-service', 'icon' => 'bi-stars', 'count' => '54 Teknisi'],
          ['name' => 'Perbaikan Perabot', 'slug' => 'perbaikan-perabot', 'icon' => 'bi-hammer', 'count' => '22 Teknisi'],
          ['name' => 'Tukang Bangunan', 'slug' => 'tukang-bangunan', 'icon' => 'bi-bricks', 'count' => '40 Teknisi'],
          ['name' => 'Pengecatan Rumah', 'slug' => 'pengecatan-rumah', 'icon' => 'bi-brush', 'count' => '26 Teknisi'],
          ['name' => 'Pengendalian Hama', 'slug' => 'pengendalian-hama', 'icon' => 'bi-shield-shaded', 'count' => '18 Teknisi'],
          ['name' => 'Perbaikan Elektronik', 'slug' => 'perbaikan-elektronik', 'icon' => 'bi-tv', 'count' => '31 Teknisi']
        ];
      @endphp

      @foreach($categoriesList as $cat)
        <a href="{{ route('public.services.index', ['category' => $cat['slug']]) }}" class="hs-cat-tile">
          <div class="hs-cat-tile-icon">
            <i class="bi {{ $cat['icon'] }}"></i>
          </div>
          <h3 style="font-size: 0.875rem; font-weight: 700; color: var(--hs-primary); margin-bottom: 3px;">{{ $cat['name'] }}</h3>
          <span style="font-size: 0.72rem; font-weight: 500; color: var(--hs-text-secondary);">{{ $cat['count'] }}</span>
        </a>
      @endforeach
    </div>
  </div>
</section>

<!-- =========================================================================
     4. "COMPLETE SERVICE FROM START TO FINISH" — SPLIT STICKY EDITORIAL
        + FLOATING TESTIMONIAL + 4 VERTICAL STEP CARDS (VISTALUX SECTION 4)
     ========================================================================= -->
<section class="hs-section" style="background-color: #F3F5F9; border-top: 1px solid var(--hs-border); border-bottom: 1px solid var(--hs-border);">
  <div class="hs-container">
    <div class="row g-5">
      <!-- Left Column: Title, CTA & Floating Testimonial Card -->
      <div class="col-lg-5 d-flex flex-column justify-content-between">
        <div>
          <span class="vl-eyebrow">Cara Kerja Pemesanan</span>
          <h2 class="vl-heading" style="margin-bottom: 16px;">
            Layanan Lengkap <strong>Dari Awal Hingga Bergaransi</strong>
          </h2>
          <p style="font-size: 0.9375rem; color: var(--hs-text-secondary); line-height: 1.65; margin-bottom: 24px;">
            Kami merancang pengalaman pemesanan jasa rumah tangga yang <strong>praktis, aman, dan transparan</strong> untuk setiap keluarga.
          </p>
          <a href="{{ route('public.services.index') }}" class="hs-btn hs-btn-primary">
            Lihat Katalog Layanan <i class="bi bi-arrow-right"></i>
          </a>
        </div>

        <!-- Floating White Testimonial Card (Bottom-Left of VistaLux Reference) -->
        <div class="hs-card" style="border-radius: 18px; padding: 26px; margin-top: 40px; position: relative; box-shadow: var(--hs-shadow-md);">
          <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=120&auto=format&fit=crop" alt="Dian Anggraini" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover; margin-bottom: 14px; border: 2px solid var(--hs-border);">
          <p style="font-size: 0.84375rem; color: var(--hs-text-secondary); line-height: 1.65; margin-bottom: 16px;">
            "AC kamar netes air parah malam hari. Pesan lewat HomeService, teknisi Pak Budi datang tepat waktu paginya. Kerjanya sangat bersih, pakai plastik pelindung dinding dan tarif sesuai aplikasi!"
          </p>
          <div style="display: flex; justify-content: space-between; align-items: flex-end;">
            <div>
              <div style="font-size: 0.72rem; color: var(--hs-text-muted);">Penghuni Apartemen Kalibata</div>
              <div style="font-size: 0.875rem; font-weight: 700; color: var(--hs-primary);">— Dian Anggraini</div>
            </div>
            <i class="bi bi-quote" style="font-size: 2rem; color: #E2E8F0; line-height: 1;"></i>
          </div>
        </div>
      </div>

      <!-- Right Column: Vertical Stack of 4 Process Cards -->
      <div class="col-lg-7">
        <div style="display: flex; flex-direction: column; gap: 18px;">
          <!-- Step 1 -->
          <div class="vl-step-card">
            <div class="vl-step-icon">
              <i class="bi bi-clipboard2-check"></i>
            </div>
            <h3 style="font-size: 1.08rem; font-weight: 700; color: var(--hs-primary); margin-bottom: 6px;">1. Konsultasi & Pilih Layanan Transparan</h3>
            <p style="font-size: 0.84375rem; color: var(--hs-text-secondary); line-height: 1.6; margin: 0;">
              Pilih spesifikasi layanan dari katalog kami dengan estimasi biaya yang tertera jelas di awal sebelum teknisi berangkat ke lokasi Anda.
            </p>
          </div>

          <!-- Step 2 -->
          <div class="vl-step-card">
            <div class="vl-step-icon">
              <i class="bi bi-person-badge"></i>
            </div>
            <h3 style="font-size: 1.08rem; font-weight: 700; color: var(--hs-primary); margin-bottom: 6px;">2. Penugasan Teknisi Ahli Terverifikasi</h3>
            <p style="font-size: 0.84375rem; color: var(--hs-text-secondary); line-height: 1.6; margin: 0;">
              Tentukan jadwal kunjungan sesuai waktu luang Anda. Sistem menugaskan mitra teknisi terdekat yang telah lolos verifikasi KTP dan sertifikasi.
            </p>
          </div>

          <!-- Step 3 (Featured with Top-Right Dark Badge) -->
          <div class="vl-step-card" style="border-color: #CBD5E1; box-shadow: var(--hs-shadow-sm);">
            <a href="{{ route('public.how-it-works') }}" style="position: absolute; top: 22px; right: 22px; width: 34px; height: 34px; background: var(--hs-primary); color: #FFFFFF; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem;">
              <i class="bi bi-arrow-up-right"></i>
            </a>
            <div class="vl-step-icon" style="background: var(--hs-primary); color: #FACC15;">
              <i class="bi bi-tools"></i>
            </div>
            <h3 style="font-size: 1.08rem; font-weight: 700; color: var(--hs-primary); margin-bottom: 6px;">3. Pengerjaan Presisi Sesuai SOP</h3>
            <p style="font-size: 0.84375rem; color: var(--hs-text-secondary); line-height: 1.6; margin: 0;">
              Teknisi datang membawa peralatan standar industri, menjaga kebersihan area kerja rumah Anda, dan melakukan uji fungsi bersama Anda.
            </p>
          </div>

          <!-- Step 4 -->
          <div class="vl-step-card">
            <div class="vl-step-icon">
              <i class="bi bi-shield-check"></i>
            </div>
            <h3 style="font-size: 1.08rem; font-weight: 700; color: var(--hs-primary); margin-bottom: 6px;">4. Pembayaran Fleksibel & Garansi 14 Hari</h3>
            <p style="font-size: 0.84375rem; color: var(--hs-text-secondary); line-height: 1.6; margin: 0;">
              Bayar tunai atau non-tunai (QRIS, Virtual Account Midtrans) setelah pekerjaan selesai, dilindungi garansi klaim perbaikan gratis 14 hari.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     5. KATALOG LAYANAN UNGGULAN & MITRA TEKNISI TERPERCAYA
     ========================================================================= -->
<section class="hs-section" style="background-color: #FFFFFF;">
  <div class="hs-container">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 36px; flex-wrap: wrap; gap: 16px;">
      <div>
        <span class="vl-eyebrow">Daftar Tarif Standar</span>
        <h2 class="vl-heading">Layanan <strong>Unggulan Terlaris</strong></h2>
      </div>
      <a href="{{ route('public.services.index') }}" class="hs-btn hs-btn-outline hs-btn-sm">
        Lihat Seluruh Katalog <i class="bi bi-chevron-right"></i>
      </a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 72px;">
      <x-service-card
        title="Cuci & Maintenance AC Split (0.5 - 2 PK)"
        category="Service AC"
        price="75000"
        image="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?q=80&w=600&auto=format&fit=crop"
        rating="4.9"
        reviewsCount="420"
        url="{{ route('public.services.show', ['slug' => 'cuci-maintenance-ac-split']) }}">
        Pembersihan evaporator, filter indoor, kipas blower, dan pengecekan tekanan freon. Bergaransi 14 hari tidak bocor.
      </x-service-card>

      <x-service-card
        title="Perbaikan Keran Bocor & Saluran Pipa Mampet"
        category="Plumbing & Air"
        price="50000"
        image="https://images.unsplash.com/photo-1585704032915-c3400ca199e7?q=80&w=600&auto=format&fit=crop"
        rating="4.8"
        reviewsCount="238"
        url="{{ route('public.services.show', ['slug' => 'perbaikan-keran-bocor']) }}">
        Penggantian seal, perbaikan instalasi pipa PVC, perbaikan kran wastafel atau shower dengan alat bertekanan.
      </x-service-card>

      <x-service-card
        title="Instalasi Lampu & Titik Saklar Baru"
        category="Instalasi Listrik"
        price="60000"
        image="https://images.unsplash.com/photo-1558227691-41ea78d1f631?q=80&w=600&auto=format&fit=crop"
        rating="4.9"
        reviewsCount="185"
        url="{{ route('public.services.show', ['slug' => 'instalasi-lampu-saklar']) }}">
        Pemasangan lampu gantung, downlight, instalasi jalur kabel baru dengan standar keselamatan PUIL & rapi.
      </x-service-card>

      <x-service-card
        title="Deep Cleaning Rumah & Kos (Per Ruangan)"
        category="Cleaning Service"
        price="100000"
        image="https://images.unsplash.com/photo-1581578731548-c64695cc6952?q=80&w=600&auto=format&fit=crop"
        rating="4.9"
        reviewsCount="310"
        url="{{ route('public.services.show', ['slug' => 'deep-cleaning-rumah']) }}">
        Pembersihan kerak kamar mandi, penyedotan debu karpet/sofa, sanitasi lantai dengan chemical ramah lingkungan.
      </x-service-card>

      <x-service-card
        title="Pengecatan Dinding Interior & Plafon"
        category="Pengecatan Rumah"
        price="150000"
        image="https://images.unsplash.com/photo-1589939705384-5185137a7f0f?q=80&w=600&auto=format&fit=crop"
        rating="4.7"
        reviewsCount="94"
        url="{{ route('public.services.show', ['slug' => 'pengecatan-dinding-interior']) }}">
        Pengerokan cat lama, plamir dinding retak rambut, dan pelapisan cat berkualitas 2-3 lapis secara merata dan rapi.
      </x-service-card>

      <x-service-card
        title="Perbaikan Mesin Cuci 1 & 2 Tabung"
        category="Perbaikan Elektronik"
        price="95000"
        image="https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?q=80&w=600&auto=format&fit=crop"
        rating="4.8"
        reviewsCount="142"
        url="{{ route('public.services.show', ['slug' => 'perbaikan-mesin-cuci']) }}">
        Pengecekan dinamo motor pengering, sensor air, kebocoran seal tabung, dan penggantian spare part bergaransi.
      </x-service-card>
    </div>

    <!-- Verified Technicians Section -->
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 36px; flex-wrap: wrap; gap: 16px;">
      <div>
        <span class="vl-eyebrow">Direktori Mitra Resmi</span>
        <h2 class="vl-heading">Mitra Teknisi <strong>Terverifikasi KTP</strong></h2>
      </div>
      <a href="{{ route('public.technicians.index') }}" class="hs-btn hs-btn-outline hs-btn-sm">
        Lihat Semua Teknisi <i class="bi bi-chevron-right"></i>
      </a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
      <x-technician-card
        name="Budi Santoso"
        skill="Spesialis AC & Pendingin"
        avatar="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=300&auto=format&fit=crop"
        rating="4.9"
        completedJobs="320"
        experienceYears="7"
        url="{{ route('public.technicians.show', ['username' => 'budi-santoso']) }}">
        Tersertifikasi BNSP Teknisi Refrigerasi, ahli AC Daikin, Panasonic, inverter dan multi-split.
      </x-technician-card>

      <x-technician-card
        name="Hendra Kusuma"
        skill="Ahli Instalasi Listrik & Panel"
        avatar="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=300&auto=format&fit=crop"
        rating="4.8"
        completedJobs="240"
        experienceYears="6"
        url="{{ route('public.technicians.show', ['username' => 'hendra-kusuma']) }}">
        Pengalaman instalasi gedung & perumahan, perbaikan korsleting darurat 24 jam dengan uji ground aman.
      </x-technician-card>

      <x-technician-card
        name="Agus Wibowo"
        skill="Master Plumbing & Pompa Air"
        avatar="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=300&auto=format&fit=crop"
        rating="5.0"
        completedJobs="190"
        experienceYears="8"
        url="{{ route('public.technicians.show', ['username' => 'agus-wibowo']) }}">
        Pakar deteksi kebocoran pipa tersembunyi, instalasi toren otomatis, dan servis pompa submersible.
      </x-technician-card>

      <x-technician-card
        name="Siti Rahmawati"
        skill="Supervisor Cleaning & Sanitasi"
        avatar="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=300&auto=format&fit=crop"
        rating="4.9"
        completedJobs="410"
        experienceYears="5"
        url="{{ route('public.technicians.show', ['username' => 'siti-rahmawati']) }}">
        Spesialis pembersihan pasca renovasi, hydro cleaning tungau kasur, dan perawatan marmer/granit.
      </x-technician-card>
    </div>
  </div>
</section>

<!-- =========================================================================
     6. "BUILT ON CRAFTSMANSHIP & RELIABILITY" — DARK ARCHITECTURAL 3x2 MATRIX
        + PARTNER CTA (VISTALUX SECTION 6)
     ========================================================================= -->
<section class="vl-craft-section">
  <div class="hs-container">
    <div style="text-align: center; max-width: 620px; margin: 0 auto 52px auto;">
      <span style="font-size: 0.78125rem; font-weight: 600; color: #94A3B8; display: block; margin-bottom: 8px;">Mengapa Memilih HomeService</span>
      <h2 style="font-family: var(--hs-font-heading); font-size: clamp(1.85rem, 3vw, 2.5rem); font-weight: 400; color: rgba(255,255,255,0.9); line-height: 1.2;">
        Dibangun di Atas <strong style="font-weight: 800; color: #FFFFFF;">Keahlian<br>& Keandalan Resmi</strong>
      </h2>
    </div>

    <!-- 3x2 Architectural Matrix Grid with Interactive Spotlight & Index Numbers -->
    <div class="vl-craft-grid" style="margin-bottom: 56px;">
      <!-- Cell 1 -->
      <div class="vl-craft-cell">
        <div class="vl-craft-header">
          <div class="vl-craft-icon"><i class="bi bi-person-badge-fill"></i></div>
          <span class="vl-craft-num">01</span>
        </div>
        <h3 style="color: #FFFFFF; font-size: 1.1rem; font-weight: 700; margin-bottom: 8px;">100% Terverifikasi KTP &amp; SKCK</h3>
        <p style="color: #94A3B8; font-size: 0.84375rem; line-height: 1.65; margin: 0;">
          Setiap mitra teknisi wajib melewati seleksi identitas KTP, wawancara teknis, serta pengecekan rekam jejak keamanan.
        </p>
      </div>

      <!-- Cell 2 -->
      <div class="vl-craft-cell">
        <div class="vl-craft-header">
          <div class="vl-craft-icon"><i class="bi bi-cash-stack"></i></div>
          <span class="vl-craft-num">02</span>
        </div>
        <h3 style="color: #FFFFFF; font-size: 1.1rem; font-weight: 700; margin-bottom: 8px;">Standar Harga Transparan</h3>
        <p style="color: #94A3B8; font-size: 0.84375rem; line-height: 1.65; margin: 0;">
          Estimasi biaya tertera sejak awal pemesanan tanpa pungutan liar. Semua rincian suku cadang tercatat di nota digital.
        </p>
      </div>

      <!-- Cell 3 -->
      <div class="vl-craft-cell">
        <div class="vl-craft-header">
          <div class="vl-craft-icon"><i class="bi bi-shield-fill-check"></i></div>
          <span class="vl-craft-num">03</span>
        </div>
        <h3 style="color: #FFFFFF; font-size: 1.1rem; font-weight: 700; margin-bottom: 8px;">Garansi Pengerjaan 14 Hari</h3>
        <p style="color: #94A3B8; font-size: 0.84375rem; line-height: 1.65; margin: 0;">
          Jika kendala yang sama berulang dalam 14 hari pasca pengerjaan, teknisi kami datang kembali memperbaiki secara gratis.
        </p>
      </div>

      <!-- Cell 4 -->
      <div class="vl-craft-cell">
        <div class="vl-craft-header">
          <div class="vl-craft-icon"><i class="bi bi-clock-history"></i></div>
          <span class="vl-craft-num">04</span>
        </div>
        <h3 style="color: #FFFFFF; font-size: 1.1rem; font-weight: 700; margin-bottom: 8px;">Ketepatan Waktu Kunjungan</h3>
        <p style="color: #94A3B8; font-size: 0.84375rem; line-height: 1.65; margin: 0;">
          Pantau status keberangkatan teknisi secara langsung dari dashboard Anda mulai dari pesanan diterima hingga tiba di lokasi.
        </p>
      </div>

      <!-- Cell 5 -->
      <div class="vl-craft-cell">
        <div class="vl-craft-header">
          <div class="vl-craft-icon"><i class="bi bi-credit-card-2-front-fill"></i></div>
          <span class="vl-craft-num">05</span>
        </div>
        <h3 style="color: #FFFFFF; font-size: 1.1rem; font-weight: 700; margin-bottom: 8px;">Pembayaran Tunai &amp; Midtrans</h3>
        <p style="color: #94A3B8; font-size: 0.84375rem; line-height: 1.65; margin: 0;">
          Mendukung pembayaran tunai di tempat maupun pembayaran digital QRIS, GoPay, dan Virtual Account BCA/Mandiri/BNI/BRI.
        </p>
      </div>

      <!-- Cell 6 -->
      <div class="vl-craft-cell">
        <div class="vl-craft-header">
          <div class="vl-craft-icon"><i class="bi bi-headset"></i></div>
          <span class="vl-craft-num">06</span>
        </div>
        <h3 style="color: #FFFFFF; font-size: 1.1rem; font-weight: 700; margin-bottom: 8px;">Pusat Resolusi &amp; Asuransi</h3>
        <p style="color: #94A3B8; font-size: 0.84375rem; line-height: 1.65; margin: 0;">
          Tim dukungan pelanggan siap memediasi keluhan dan memberikan perlindungan risiko selama pengerjaan berlangsung.
        </p>
      </div>
    </div>

    <!-- Bottom Partner Recruitment Bar Inside Craft Section -->
    <div style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 18px; padding: 36px 40px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 24px;">
      <div style="max-width: 580px;">
        <span style="color: #FACC15; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Peluang Karir Mitra Teknisi</span>
        <h3 style="color: #FFFFFF; font-size: 1.5rem; font-weight: 800; margin-top: 4px; margin-bottom: 8px;">
          Apakah Anda Teknisi Ahli? Bergabunglah Bersama Kami.
        </h3>
        <p style="color: #94A3B8; font-size: 0.875rem; margin: 0;">
          Dapatkan pesanan rutin setiap hari, jadwal fleksibel, dan pencairan saldo instan ke rekening BCA, Mandiri, BNI, atau BRI Anda.
        </p>
      </div>
      <div style="display: flex; flex-wrap: wrap; gap: 12px;">
        <a href="{{ route('provider.register') }}" class="hs-btn vl-btn-amber hs-btn-lg">
          Daftar Sebagai Teknisi <i class="bi bi-arrow-right"></i>
        </a>
        <a href="{{ route('public.contact') }}" class="hs-btn hs-btn-outline-light hs-btn-lg">
          Konsultasi Kemitraan
        </a>
      </div>
    </div>
  </div>
</section>
@endsection
