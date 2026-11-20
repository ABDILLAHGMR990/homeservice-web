<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Customer Dashboard - HomeService')</title>

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

  <!-- Dashboard Top Header -->
  <header style="height: 68px; background: #FFFFFF; border-bottom: 1px solid var(--hs-border); display: flex; align-items: center; position: sticky; top: 0; z-index: 900;">
    <div class="hs-container-fluid" style="display: flex; justify-content: space-between; align-items: center;">
      <!-- Brand Logo -->
      <a href="{{ url('/') }}" class="hs-brand-logo">
        <div class="hs-brand-icon">
          <i class="bi bi-house-gear-fill"></i>
        </div>
        <div>Home<span>Service</span> <span style="font-size: 0.6875rem; font-weight: 700; letter-spacing: 0.04em; background: var(--hs-primary-surface); color: var(--hs-primary); padding: 3px 8px; border-radius: 4px; margin-left: 6px;">PELANGGAN</span></div>
      </a>

      <!-- Right Header Elements -->
      <div style="display: flex; align-items: center; gap: 16px;">
        <a href="{{ route('public.services.index') }}" class="hs-btn hs-btn-primary hs-btn-sm">
          <i class="bi bi-plus-circle"></i> Pesan Jasa Baru
        </a>

        <!-- Notification Bell -->
        <a href="{{ route('customer.notifications.index') }}" class="hs-btn hs-btn-ghost hs-btn-sm" style="position: relative; padding: 8px;" title="Notifikasi">
          <i class="bi bi-bell" style="font-size: 1.15rem;"></i>
          <span style="position: absolute; top: 6px; right: 6px; width: 7px; height: 7px; background-color: var(--hs-danger); border-radius: 50%;"></span>
        </a>

        <!-- User Profile Pill -->
        <a href="{{ route('customer.profile.edit') }}" style="display: flex; align-items: center; gap: 10px; border-left: 1px solid var(--hs-border); padding-left: 16px;">
          <div style="width: 36px; height: 36px; background: var(--hs-primary-surface); color: var(--hs-primary); font-weight: 700; font-size: 0.875rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 1px solid var(--hs-border);">
            {{ strtoupper(substr(auth()->user()->name ?? 'C', 0, 1)) }}
          </div>
          <div>
            <div style="font-weight: 600; font-size: 0.84375rem; color: var(--hs-primary); line-height: 1.2;">{{ auth()->user()->name ?? 'Pelanggan' }}</div>
            <div style="font-size: 0.72rem; color: var(--hs-text-secondary);">Member Terverifikasi</div>
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

  <!-- Dashboard Workspace Layout -->
  <div class="hs-dashboard-wrapper">
    <!-- Customer Sidebar -->
    <aside class="hs-sidebar">
      <div class="hs-sidebar-section-title">Menu Utama</div>
      <ul class="hs-sidebar-menu">
        <li class="hs-sidebar-item {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
          <a href="{{ route('customer.dashboard') }}">
            <i class="bi bi-grid-1x2-fill"></i> Ringkasan Dashboard
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('customer.bookings.*') ? 'active' : '' }}">
          <a href="{{ route('customer.bookings.index') }}">
            <i class="bi bi-clipboard2-check-fill"></i> Pesanan Saya
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('customer.addresses.*') ? 'active' : '' }}">
          <a href="{{ route('customer.addresses.index') }}">
            <i class="bi bi-geo-alt-fill"></i> Alamat Tersimpan
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('customer.favorites.*') ? 'active' : '' }}">
          <a href="{{ route('customer.favorites.index') }}">
            <i class="bi bi-heart-fill"></i> Teknisi Favorit
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('customer.chat.*') ? 'active' : '' }}">
          <a href="{{ route('customer.chat.index') }}">
            <i class="bi bi-chat-dots-fill"></i> Chat Teknisi
          </a>
        </li>
      </ul>

      <div class="hs-sidebar-section-title" style="margin-top: 12px;">Akun & Bantuan</div>
      <ul class="hs-sidebar-menu">
        <li class="hs-sidebar-item {{ request()->routeIs('customer.notifications.*') ? 'active' : '' }}">
          <a href="{{ route('customer.notifications.index') }}">
            <i class="bi bi-bell-fill"></i> Notifikasi
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('customer.complaints.*') ? 'active' : '' }}">
          <a href="{{ route('customer.complaints.index') }}">
            <i class="bi bi-shield-exclamation"></i> Pengaduan & Garansi
          </a>
        </li>
        <li class="hs-sidebar-item {{ request()->routeIs('customer.profile.*') ? 'active' : '' }}">
          <a href="{{ route('customer.profile.edit') }}">
            <i class="bi bi-person-gear"></i> Pengaturan Profil
          </a>
        </li>
        <li class="hs-sidebar-item">
          <a href="{{ route('public.faq') }}">
            <i class="bi bi-question-circle-fill"></i> Pusat Bantuan
          </a>
        </li>
      </ul>

      <!-- Quick Back to Website Link -->
      <div style="border-top: 1px solid var(--hs-border); padding-top: 14px; margin-top: auto;">
        <a href="{{ url('/') }}" class="hs-btn hs-btn-outline-secondary hs-btn-sm w-100" style="justify-content: flex-start;">
          <i class="bi bi-arrow-left"></i> Kembali ke Beranda
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
