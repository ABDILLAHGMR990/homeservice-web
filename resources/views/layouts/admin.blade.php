<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Central Hub - HomeService')</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&family=Lora:ital,wght@0,500;0,600;1,500;1,600&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- HomeService Design System CSS -->
  <link rel="stylesheet" href="{{ asset('css/homeservice-design-system.css') }}?v=3.2">
  <link rel="stylesheet" href="{{ asset('css/homeservice-extensions.css') }}?v=3.2">
  @stack('styles')
</head>
<body style="background-color: var(--hs-bg-main);">

  <!-- Admin Dashboard Top Header -->
  <header style="height: 66px; background: #091322; color: #FFFFFF; display: flex; align-items: center; position: sticky; top: 0; z-index: 900; border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="hs-container-fluid" style="display: flex; justify-content: space-between; align-items: center;">
      <!-- Brand Logo -->
      <a href="{{ url('/') }}" class="hs-brand-logo" style="color: #FFFFFF;">
        <div class="hs-brand-icon" style="background-color: var(--hs-secondary); color: var(--hs-primary);">
          <i class="bi bi-shield-lock-fill"></i>
        </div>
        <div style="display: flex; align-items: center; gap: 10px;">
          <span>Home<span style="color: var(--hs-secondary);">Service</span></span>
          <span class="hs-font-mono" style="font-size: 0.65rem; font-weight: 600; letter-spacing: 0.08em; border: 1px solid rgba(255,255,255,0.2); color: #CBD5E1; padding: 2px 8px; border-radius: 4px;">ADMIN CENTRAL</span>
        </div>
      </a>

      <!-- Right Header Actions -->
      <div style="display: flex; align-items: center; gap: 18px;">
        <!-- Crisp Technical System Status -->
        <div class="hs-font-mono" style="display: flex; align-items: center; gap: 8px; font-size: 0.72rem; color: #94A3B8; border-right: 1px solid rgba(255,255,255,0.12); padding-right: 18px;">
          <span style="width: 7px; height: 7px; border-radius: 50%; background: #10B981;"></span>
          <span>MIDTRANS: AKTIF</span>
        </div>

        <!-- Superadmin Profile -->
        <div style="display: flex; align-items: center; gap: 10px;">
          <div style="width: 34px; height: 34px; background: var(--hs-secondary); color: var(--hs-primary); font-weight: 800; font-size: 0.85rem; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
          </div>
          <div>
            <div style="font-weight: 600; font-size: 0.84375rem; color: #FFFFFF; line-height: 1.2;">{{ auth()->user()->name ?? 'Administrator' }}</div>
            <div style="font-size: 0.7rem; color: #94A3B8;">Operasional Pusat</div>
          </div>
        </div>

        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="hs-btn hs-btn-ghost hs-btn-sm" style="color: #CBD5E1;" title="Keluar">
            <i class="bi bi-box-arrow-right"></i> Keluar
          </button>
        </form>
      </div>
    </div>
  </header>

  <!-- Admin Dashboard Layout -->
  <div class="hs-dashboard-wrapper">
    <!-- Admin Sidebar -->
    <aside class="hs-sidebar">
      <div class="hs-sidebar-section-title">Ringkasan & Mitra</div>
      <ul class="hs-sidebar-menu">
        <li class="hs-sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <a href="{{ route('admin.dashboard') }}">
            <i class="bi bi-grid-1x2-fill"></i> Statistik & Metrik
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
          <a href="{{ route('admin.users.index') }}">
            <i class="bi bi-people-fill"></i> Pengguna & Teknisi
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('admin.verifications.*') ? 'active' : '' }}">
          <a href="{{ route('admin.verifications.index') }}">
            <i class="bi bi-patch-check-fill"></i> Verifikasi KTP Mitra
          </a>
        </li>
      </ul>

      <div class="hs-sidebar-section-title" style="margin-top: 12px;">Katalog & Operasional</div>
      <ul class="hs-sidebar-menu">
        <li class="hs-sidebar-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
          <a href="{{ route('admin.categories.index') }}">
            <i class="bi bi-folder-fill"></i> Master Kategori
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
          <a href="{{ route('admin.services.index') }}">
            <i class="bi bi-tools"></i> Standar Layanan
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
          <a href="{{ route('admin.bookings.index') }}">
            <i class="bi bi-receipt-cutoff"></i> Monitoring Pesanan
          </a>
        </li>
      </ul>

      <div class="hs-sidebar-section-title" style="margin-top: 12px;">Finansial & Sistem</div>
      <ul class="hs-sidebar-menu">
        <li class="hs-sidebar-item {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
          <a href="{{ route('admin.payments.index') }}">
            <i class="bi bi-cash-coin"></i> Rekonsiliasi Pembayaran
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('admin.complaints.*') ? 'active' : '' }}">
          <a href="{{ route('admin.complaints.index') }}">
            <i class="bi bi-shield-exclamation"></i> Resolusi Pengaduan
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
          <a href="{{ route('admin.settings.index') }}">
            <i class="bi bi-sliders"></i> Pengaturan Komisi
          </a>
        </li>
      </ul>

      <!-- Quick Back to Website Link -->
      <div style="border-top: 1px solid var(--hs-border); padding-top: 14px; margin-top: auto;">
        <a href="{{ url('/') }}" class="hs-btn hs-btn-outline-secondary hs-btn-sm w-100" style="justify-content: flex-start;">
          <i class="bi bi-arrow-left"></i> Lihat Website Publik
        </a>
      </div>
    </aside>

    <!-- Main Content Panel -->
    <main class="hs-main-content">
      @if(session('success'))
        <div class="hs-alert hs-alert-success">
          <i class="bi bi-check-circle-fill" style="font-size: 1.15rem;"></i>
          <div>{{ session('success') }}</div>
        </div>
      @endif

      @if(session('error'))
        <div class="hs-alert hs-alert-danger">
          <i class="bi bi-exclamation-triangle-fill" style="font-size: 1.15rem;"></i>
          <div>{{ session('error') }}</div>
        </div>
      @endif

      @yield('content')
    </main>
  </div>

  <!-- Core JavaScript -->
  <script src="{{ asset('js/homeservice-core.js') }}?v=3.0"></script>
  @stack('scripts')
</body>
</html>
