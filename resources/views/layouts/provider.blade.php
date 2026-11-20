<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Mitra Teknisi Dashboard - HomeService')</title>

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

  <!-- Provider Dashboard Top Header -->
  <header style="height: 68px; background: #FFFFFF; border-bottom: 1px solid var(--hs-border); display: flex; align-items: center; position: sticky; top: 0; z-index: 900;">
    <div class="hs-container-fluid" style="display: flex; justify-content: space-between; align-items: center;">
      <!-- Brand Logo -->
      <a href="{{ url('/') }}" class="hs-brand-logo">
        <div class="hs-brand-icon" style="background-color: var(--hs-secondary); color: var(--hs-primary);">
          <i class="bi bi-tools"></i>
        </div>
        <div>Home<span>Service</span> <span style="font-size: 0.6875rem; font-weight: 700; letter-spacing: 0.04em; background: var(--hs-primary-surface); color: var(--hs-primary); padding: 3px 8px; border-radius: 4px; margin-left: 6px;">MITRA TEKNISI</span></div>
      </a>

      <!-- Right Header Actions -->
      <div style="display: flex; align-items: center; gap: 16px;">
        <!-- Work Status Switch -->
        <div style="display: flex; align-items: center; gap: 8px; background: #ECFDF5; border: 1px solid #A7F3D0; padding: 6px 14px; border-radius: var(--hs-radius-full); font-size: 0.78125rem; font-weight: 600; color: #065F46;">
          <span class="hs-pulse-dot"></span>
          <span>Status: Siap Menerima Order</span>
        </div>

        <!-- Verification Badge -->
        <span class="hs-badge hs-badge-success">
          <i class="bi bi-patch-check-fill"></i> KTP Terverifikasi
        </span>

        <!-- Profile Pill -->
        <a href="{{ route('provider.profile.edit') }}" style="display: flex; align-items: center; gap: 10px; border-left: 1px solid var(--hs-border); padding-left: 16px;">
          <div style="width: 36px; height: 36px; background: var(--hs-secondary-surface); color: #B45309; font-weight: 700; font-size: 0.875rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 1px solid #FDE68A;">
            {{ strtoupper(substr(auth()->user()->name ?? 'B', 0, 1)) }}
          </div>
          <div>
            <div style="font-weight: 600; font-size: 0.84375rem; color: var(--hs-primary); line-height: 1.2;">{{ auth()->user()->name ?? 'Mitra Teknisi' }}</div>
            <div style="font-size: 0.72rem; color: var(--hs-text-secondary);">{{ auth()->user()->providerProfile->expertise ?? 'Spesialis Rumah Tangga' }}</div>
          </div>
        </a>

        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="hs-btn hs-btn-ghost hs-btn-sm" title="Keluar">
            <i class="bi bi-box-arrow-right"></i>
          </button>
        </form>
      </div>
    </div>
  </header>

  <!-- Provider Dashboard Layout -->
  <div class="hs-dashboard-wrapper">
    <!-- Provider Sidebar -->
    <aside class="hs-sidebar">
      <div class="hs-sidebar-section-title">Operasional Mitra</div>
      <ul class="hs-sidebar-menu">
        <li class="hs-sidebar-item {{ request()->routeIs('provider.dashboard') ? 'active' : '' }}">
          <a href="{{ route('provider.dashboard') }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard Utama
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('provider.bookings.*') ? 'active' : '' }}">
          <a href="{{ route('provider.bookings.index') }}">
            <i class="bi bi-clipboard2-check-fill"></i> Pekerjaan & Order
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('provider.services.*') ? 'active' : '' }}">
          <a href="{{ route('provider.services.index') }}">
            <i class="bi bi-tools"></i> Layanan & Tarif Saya
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('provider.chat.*') ? 'active' : '' }}">
          <a href="{{ route('provider.chat.index') }}">
            <i class="bi bi-chat-dots-fill"></i> Pesan Pelanggan
          </a>
        </li>
      </ul>

      <div class="hs-sidebar-section-title" style="margin-top: 12px;">Finansial & Akun</div>
      <ul class="hs-sidebar-menu">
        <li class="hs-sidebar-item {{ request()->routeIs('provider.earnings.*') ? 'active' : '' }}">
          <a href="{{ route('provider.earnings.index') }}">
            <i class="bi bi-wallet2"></i> Pendapatan & Saldo
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('provider.verification.*') ? 'active' : '' }}">
          <a href="{{ route('provider.verification.index') }}">
            <i class="bi bi-shield-check"></i> Verifikasi Dokumen KTP
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('provider.profile.*') ? 'active' : '' }}">
          <a href="{{ route('provider.profile.edit') }}">
            <i class="bi bi-person-gear"></i> Profil & Ketersediaan
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
