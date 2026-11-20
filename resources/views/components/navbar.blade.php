<nav class="hs-navbar" id="main-nav">
  <div class="hs-container hs-nav-wrapper">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="hs-brand-logo">
      <div class="hs-brand-icon">
        <i class="bi bi-house-gear-fill"></i>
      </div>
      <div>Home<span>Service</span></div>
    </a>

    <!-- Desktop Navigation Menu (Animated Glide Taskbar) -->
    <ul class="hs-nav-menu" id="hs-nav-menu">
      <span class="hs-nav-glide" id="hs-nav-glide" aria-hidden="true"></span>
      <li>
        <a href="{{ url('/') }}" class="hs-nav-link {{ request()->is('/') ? 'active' : '' }}">
          Beranda
        </a>
      </li>
      <li>
        <a href="{{ route('public.categories.index') }}" class="hs-nav-link {{ request()->is('kategori*') ? 'active' : '' }}">
          Kategori
        </a>
      </li>
      <li>
        <a href="{{ route('public.services.index') }}" class="hs-nav-link {{ request()->is('layanan*') ? 'active' : '' }}">
          Katalog Layanan
        </a>
      </li>
      <li>
        <a href="{{ route('public.technicians.index') }}" class="hs-nav-link {{ request()->is('teknisi*') ? 'active' : '' }}">
          Mitra Teknisi
        </a>
      </li>
      <li>
        <a href="{{ route('public.how-it-works') }}" class="hs-nav-link {{ request()->is('cara-kerja*') ? 'active' : '' }}">
          Cara Kerja
        </a>
      </li>
      <li>
        <a href="{{ route('public.about') }}" class="hs-nav-link {{ request()->is('tentang*') ? 'active' : '' }}">
          Tentang Kami
        </a>
      </li>
    </ul>

    <!-- Right Navigation Actions -->
    <div class="hs-nav-actions">
      @auth
        @if(auth()->user()->role === 'customer')
          <a href="{{ route('customer.dashboard') }}" class="hs-btn hs-btn-outline hs-btn-sm">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard Saya
          </a>
        @elseif(auth()->user()->role === 'provider')
          <a href="{{ route('provider.dashboard') }}" class="hs-btn hs-btn-outline hs-btn-sm">
            <i class="bi bi-tools"></i> Panel Teknisi
          </a>
        @elseif(auth()->user()->role === 'admin')
          <a href="{{ route('admin.dashboard') }}" class="hs-btn hs-btn-primary hs-btn-sm">
            <i class="bi bi-shield-lock-fill"></i> Panel Admin
          </a>
        @endif

        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="hs-btn hs-btn-ghost hs-btn-sm" title="Keluar Akun">
            <i class="bi bi-box-arrow-right"></i> Keluar
          </button>
        </form>
      @else
        <a href="{{ route('login') }}" class="hs-btn hs-btn-ghost hs-btn-sm">
          Masuk
        </a>
        <a href="{{ route('register') }}" class="hs-btn hs-btn-primary hs-btn-sm">
          Daftar Akun <i class="bi bi-arrow-right"></i>
        </a>
      @endauth

      <!-- Mobile Menu Button -->
      <button class="hs-btn hs-btn-ghost hs-btn-sm hs-mobile-toggle" id="hs-mobile-toggle" style="display: none;" aria-label="Toggle Navigation">
        <i class="bi bi-list" style="font-size: 1.4rem;"></i>
      </button>
    </div>
  </div>
</nav>
