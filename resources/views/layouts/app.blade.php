<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="HomeService - Your Home, Our Service. Platform marketplace jasa rumah tangga terpercaya, cepat, dan profesional.">
  <meta name="author" content="HomeService Engineering Team">
  <title>@yield('title', 'HomeService - Your Home, Our Service')</title>

  <!-- Google Fonts: Plus Jakarta Sans, Lora, Inter & JetBrains Mono -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&family=Lora:ital,wght@0,500;0,600;1,500;1,600&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

  <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- HomeService Design System CSS -->
  <link rel="stylesheet" href="{{ asset('css/homeservice-design-system.css') }}?v=3.4">
  <link rel="stylesheet" href="{{ asset('css/homeservice-extensions.css') }}?v=3.4">
  @stack('styles')
</head>
<body>

  <!-- Top Commercial Utility Strip -->
  <aside style="background-color: #F8FAFC; color: #475569; font-size: 0.78125rem; padding: 7px 0; border-bottom: 1px solid #E2E8F0;" aria-label="Informasi Operasional">
    <div class="hs-container" style="display: flex; justify-content: space-between; align-items: center; gap: 16px; flex-wrap: wrap;">
      <div style="display: flex; align-items: center; gap: 14px; flex-wrap: wrap;">
        <span style="display: inline-flex; align-items: center; gap: 6px; font-weight: 500; color: #0F2540;">
          <i class="bi bi-geo-alt-fill" style="color: #D97706;"></i> Area Layanan: Jabodetabek
        </span>
        <span style="color: #CBD5E1;">|</span>
        <span style="display: inline-flex; align-items: center; gap: 6px;">
          <i class="bi bi-clock" style="color: #64748B;"></i> Buka Setiap Hari, 07.00 – 21.00 WIB
        </span>
        <span style="color: #CBD5E1;">|</span>
        <span style="display: inline-flex; align-items: center; gap: 6px;">
          <i class="bi bi-shield-check" style="color: #059669;"></i> Garansi Pengerjaan 14 Hari
        </span>
      </div>
      <div style="display: flex; align-items: center; gap: 16px;">
        <a href="{{ route('public.faq') }}" style="color: #475569; font-weight: 500;">Pusat Bantuan</a>
        <span style="color: #CBD5E1;">|</span>
        <a href="tel:080014663" style="color: #0F2540; font-weight: 600; display: inline-flex; align-items: center; gap: 5px;">
          <i class="bi bi-telephone"></i> 0800-1-4663
        </a>
        <span style="color: #CBD5E1;">|</span>
        <a href="{{ route('provider.register') }}" style="color: #B45309; font-weight: 600; display: inline-flex; align-items: center; gap: 5px;">
          Gabung Mitra Teknisi <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>
  </aside>

  <!-- Main Navbar Component -->
  @include('components.navbar')

  <!-- Main Content Body -->
  <main>
    @if(session('success'))
      <div class="hs-container" style="padding-top: 20px;">
        <div class="hs-alert hs-alert-success">
          <i class="bi bi-check-circle-fill" style="font-size: 1.2rem;"></i>
          <div>{{ session('success') }}</div>
        </div>
      </div>
    @endif

    @if(session('error'))
      <div class="hs-container" style="padding-top: 20px;">
        <div class="hs-alert hs-alert-danger">
          <i class="bi bi-exclamation-triangle-fill" style="font-size: 1.2rem;"></i>
          <div>{{ session('error') }}</div>
        </div>
      </div>
    @endif

    @yield('content')
  </main>

  <!-- Main Footer Component -->
  @include('components.footer')

  <!-- Core JavaScript -->
  <script src="{{ asset('js/homeservice-core.js') }}?v=3.4"></script>
  @stack('scripts')
</body>
</html>
