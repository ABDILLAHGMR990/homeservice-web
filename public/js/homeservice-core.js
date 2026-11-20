/**
 * HomeService Core JS v2.0 — Interactive Micro-Physics & Commercial UX Engine
 * Features: Tactile Click Ripple, Staggered Scroll Reveal, Top Progress Bar,
 *           Sticky Navbar Depth, Modals, Dropdowns, Toast, Booking Calculator
 */

(function () {
  'use strict';

  /* ─── 1. Top Navigation Progress Bar ────────────────────────────────── */
  const progressBar = document.createElement('div');
  progressBar.id = 'hs-top-progress';
  document.body.prepend(progressBar);

  function startProgress() {
    progressBar.style.opacity = '1';
    progressBar.style.width = '35%';
    setTimeout(() => {
      if (progressBar.style.opacity === '1') progressBar.style.width = '72%';
    }, 180);
  }

  function finishProgress() {
    progressBar.style.width = '100%';
    setTimeout(() => {
      progressBar.style.opacity = '0';
      setTimeout(() => { progressBar.style.width = '0%'; }, 200);
    }, 160);
  }

  window.addEventListener('pageshow', finishProgress);

  document.addEventListener('click', function (e) {
    const link = e.target.closest('a[href]');
    if (!link) return;
    const href = link.getAttribute('href');
    if (
      href &&
      !href.startsWith('#') &&
      !href.startsWith('javascript:') &&
      !link.hasAttribute('target') &&
      !link.hasAttribute('data-modal-open') &&
      !link.hasAttribute('data-confirm') &&
      !e.ctrlKey && !e.metaKey && !e.shiftKey
    ) {
      startProgress();
    }
  });

  /* ─── 2. Tactile Mechanical Press, Spring Rebound & Click Ripple ────── */
  const pressSelectors = '.hs-btn, .hs-cat-tile, .hs-card-hover, .vl-pillar-card, .vl-craft-cell, .hs-nav-link, .hs-sidebar-item a, .hs-page-link, .hs-tab';

  // Interactive Mouse Spotlight Tracking for Craft Matrix & Pillar Cards
  document.addEventListener('mousemove', function (e) {
    const cards = document.querySelectorAll('.vl-craft-cell, .vl-pillar-card');
    cards.forEach(card => {
      const rect = card.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      card.style.setProperty('--mouse-x', `${x}px`);
      card.style.setProperty('--mouse-y', `${y}px`);
    });
  }, { passive: true });

  document.addEventListener('pointerdown', function (e) {
    const target = e.target.closest(pressSelectors);
    if (!target || target.disabled || target.classList.contains('disabled')) return;

    // 1. Mechanical Push-Down State
    target.classList.remove('hs-rebound');
    target.classList.add('hs-pressing');

    // 2. Inner Ink Ripple Wave
    const rect = target.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height) * 1.15;
    const x = e.clientX - rect.left - size / 2;
    const y = e.clientY - rect.top - size / 2;

    const ripple = document.createElement('span');
    ripple.className = 'hs-ripple-wave';
    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = x + 'px';
    ripple.style.top = y + 'px';
    target.appendChild(ripple);
    setTimeout(() => ripple.remove(), 550);

    // 3. Outer Tactile Click Ring at Cursor
    const ring = document.createElement('span');
    ring.className = 'hs-click-ring';
    ring.style.left = e.clientX + 'px';
    ring.style.top = e.clientY + 'px';
    document.body.appendChild(ring);
    setTimeout(() => ring.remove(), 420);
  });

  function releasePress(e) {
    document.querySelectorAll('.hs-pressing').forEach(el => {
      el.classList.remove('hs-pressing');
      if (el.classList.contains('hs-btn')) {
        el.classList.add('hs-rebound');
        setTimeout(() => el.classList.remove('hs-rebound'), 380);
      }
    });
  }

  document.addEventListener('pointerup', releasePress);
  document.addEventListener('pointercancel', releasePress);

  /* ─── 3. Staggered Scroll & Viewport Reveal ─────────────────────────── */
  function initScrollReveal() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    const selectors = [
      '.hs-service-card',
      '.hs-technician-card',
      '.hs-stat-card',
      '.hs-card'
    ];
    const elements = document.querySelectorAll(selectors.join(','));
    if (!elements.length || !('IntersectionObserver' in window)) return;

    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('hs-revealed');
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.06, rootMargin: '0px 0px -24px 0px' });

    elements.forEach((el, idx) => {
      // Only animate elements not already inside hidden modals
      if (el.closest('#modalAddUser, .hs-modal-overlay')) return;
      el.classList.add('hs-reveal');
      const siblingIndex = Array.from(el.parentElement ? el.parentElement.children : []).indexOf(el);
      const delay = Math.min(Math.max(siblingIndex, 0) * 45, 220);
      el.style.transitionDelay = delay + 'ms';
      observer.observe(el);
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initScrollReveal);
  } else {
    initScrollReveal();
  }

  /* ─── 4. Sticky Navbar Scroll Depth & Sliding Taskbar Animation ────── */
  const mainNav = document.getElementById('main-nav');
  if (mainNav) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 12) {
        mainNav.classList.add('hs-navbar-scrolled');
      } else {
        mainNav.classList.remove('hs-navbar-scrolled');
      }
    }, { passive: true });
  }

  function initTaskbarGlide() {
    const menu  = document.getElementById('hs-nav-menu');
    const glide = document.getElementById('hs-nav-glide');
    if (!menu || !glide) return;

    const links = Array.from(menu.querySelectorAll('.hs-nav-link'));
    if (!links.length) return;

    function moveGlide(targetLink) {
      if (!targetLink || window.innerWidth <= 991) {
        glide.style.opacity = '0';
        return;
      }
      const menuRect = menu.getBoundingClientRect();
      const linkRect = targetLink.getBoundingClientRect();
      const offsetX  = linkRect.left - menuRect.left;

      glide.style.width = `${linkRect.width}px`;
      glide.style.transform = `translateX(${offsetX}px)`;
      glide.style.opacity = '1';
    }

    const activeLink = menu.querySelector('.hs-nav-link.active, .hs-nav-link.hs-nav-active') || links[0];

    // Position immediately after fonts settle
    setTimeout(() => moveGlide(activeLink), 60);
    window.addEventListener('resize', () => moveGlide(activeLink));

    links.forEach(link => {
      link.addEventListener('mouseenter', () => moveGlide(link));
    });

    menu.addEventListener('mouseleave', () => moveGlide(activeLink));
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTaskbarGlide);
  } else {
    initTaskbarGlide();
  }

  /* ─── 4B. Hero Interactive Motion: Count-Up, Cycling Placeholder & Parallax ─ */
  function initHeroAnimations() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    // 1. Stat Count-Up Animation
    document.querySelectorAll('[data-countup]').forEach(el => {
      const target   = parseFloat(el.dataset.countup);
      const decimals = parseInt(el.dataset.decimals || '0', 10);
      const suffix   = el.dataset.suffix || '';
      const duration = 1200;
      const start    = performance.now();

      function tick(now) {
        const progress = Math.min((now - start) / duration, 1);
        const eased    = 1 - Math.pow(1 - progress, 3);
        const val      = target * eased;

        if (decimals > 0) {
          el.textContent = val.toFixed(decimals) + suffix;
        } else {
          el.textContent = Math.round(val).toLocaleString('id-ID') + suffix;
        }

        if (progress < 1) {
          requestAnimationFrame(tick);
        } else {
          el.textContent = (decimals > 0 ? target.toFixed(decimals) : target.toLocaleString('id-ID')) + suffix;
        }
      }
      requestAnimationFrame(tick);
    });

    // 2. Cycling Search Placeholder
    const searchInput = document.getElementById('hero-search-input');
    if (searchInput) {
      const queries = [
        'Cari layanan: Cuci AC Split 1 PK...',
        'Cari layanan: Perbaikan Pipa & Keran Bocor...',
        'Cari layanan: Instalasi Lampu & Panel MCB...',
        'Cari layanan: Deep Cleaning Rumah & Sofa...',
        'Cari layanan: Servis Mesin Cuci & Kulkas...'
      ];
      let idx = 0;
      setInterval(() => {
        if (document.activeElement === searchInput || searchInput.value.trim() !== '') return;
        idx = (idx + 1) % queries.length;
        searchInput.placeholder = queries[idx];
      }, 3200);
    }

    // 3. Subtle Mouse Parallax on Hero Spec Panel & Background
    const heroSection = document.querySelector('.vl-hero');
    const heroBg      = document.querySelector('.vl-hero-bg-layer');
    const specPanel   = document.getElementById('vl-hero-spec-panel');

    if (heroSection && (heroBg || specPanel) && window.innerWidth >= 992) {
      heroSection.addEventListener('mousemove', function (e) {
        const rect = heroSection.getBoundingClientRect();
        const nx   = (e.clientX - rect.left) / rect.width - 0.5;
        const ny   = (e.clientY - rect.top) / rect.height - 0.5;

        if (specPanel) {
          specPanel.style.transform = `translate3d(${nx * -8}px, ${ny * -8}px, 0)`;
        }
      }, { passive: true });

      heroSection.addEventListener('mouseleave', function () {
        if (specPanel) {
          specPanel.style.transform = '';
        }
      });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHeroAnimations);
  } else {
    initHeroAnimations();
  }

  /* ─── 5. Mobile Navigation ──────────────────────────────────────────── */
  const mobileToggle = document.getElementById('hs-mobile-toggle');
  const navMenu      = document.getElementById('hs-nav-menu');

  if (mobileToggle && navMenu) {
    mobileToggle.addEventListener('click', function () {
      navMenu.classList.toggle('hs-nav-open');
      const icon = this.querySelector('i');
      if (icon) {
        icon.className = navMenu.classList.contains('hs-nav-open')
          ? 'bi bi-x-lg'
          : 'bi bi-list';
      }
    });

    document.addEventListener('click', function (e) {
      if (!navMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
        navMenu.classList.remove('hs-nav-open');
        const icon = mobileToggle.querySelector('i');
        if (icon) icon.className = 'bi bi-list';
      }
    });
  }

  /* ─── 6. Dashboard Sidebar Toggle (Mobile) ──────────────────────────── */
  const sidebarToggle = document.getElementById('hs-sidebar-toggle');
  const sidebar       = document.querySelector('.hs-sidebar, .hs-dashboard-sidebar');

  if (sidebarToggle && sidebar) {
    sidebarToggle.addEventListener('click', function () {
      sidebar.classList.toggle('hs-sidebar-open');
    });
  }

  /* ─── 7. Modal System ───────────────────────────────────────────────── */
  window.hsModal = {
    open: function (id) {
      const modal = document.getElementById(id);
      if (modal) {
        modal.classList.add('hs-modal-active');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
          const first = modal.querySelector('input:not([type="hidden"]), textarea, select');
          if (first) first.focus();
        }, 80);
      }
    },
    close: function (id) {
      const modal = document.getElementById(id);
      if (modal) {
        modal.classList.remove('hs-modal-active');
        modal.style.display = 'none';
        document.body.style.overflow = '';
      }
    },
    closeAll: function () {
      document.querySelectorAll('.hs-modal-overlay.hs-modal-active, #modalAddUser').forEach(m => {
        m.classList.remove('hs-modal-active');
        m.style.display = 'none';
      });
      document.body.style.overflow = '';
    }
  };

  document.addEventListener('click', function (e) {
    const trigger = e.target.closest('[data-modal-open], [data-hs-modal-target]');
    if (trigger) {
      e.preventDefault();
      const targetId = trigger.dataset.modalOpen || trigger.dataset.hsModalTarget;
      hsModal.open(targetId);
    }

    const closeBtn = e.target.closest('[data-modal-close], [data-hs-modal-close], .hs-modal-close');
    if (closeBtn) {
      const modal = closeBtn.closest('.hs-modal-overlay, .hs-modal');
      if (modal) {
        modal.classList.remove('hs-modal-active');
        modal.style.display = 'none';
        document.body.style.overflow = '';
      }
    }
  });

  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('hs-modal-overlay')) {
      e.target.classList.remove('hs-modal-active');
      e.target.style.display = 'none';
      document.body.style.overflow = '';
    }
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      hsModal.closeAll();
    }
  });

  /* ─── 8. Dropdown System ────────────────────────────────────────────── */
  document.addEventListener('click', function (e) {
    const trigger = e.target.closest('[data-dropdown-toggle]');
    if (trigger) {
      e.preventDefault();
      const targetId = trigger.dataset.dropdownToggle;
      const dropdown = document.getElementById(targetId);
      if (!dropdown) return;

      document.querySelectorAll('.hs-dropdown-menu.hs-dropdown-open').forEach(d => {
        if (d !== dropdown) d.classList.remove('hs-dropdown-open');
      });

      dropdown.classList.toggle('hs-dropdown-open');
    } else {
      document.querySelectorAll('.hs-dropdown-menu.hs-dropdown-open').forEach(d => {
        d.classList.remove('hs-dropdown-open');
      });
    }
  });

  /* ─── 9. Toast Notifications ────────────────────────────────────────── */
  window.hsToast = function (message, type = 'default', duration = 4000) {
    let container = document.getElementById('hs-toast-container');
    if (!container) {
      container = document.createElement('div');
      container.id = 'hs-toast-container';
      container.className = 'hs-toast-container';
      document.body.appendChild(container);
    }

    const icons = {
      success: 'bi-check-circle-fill',
      error:   'bi-x-circle-fill',
      warning: 'bi-exclamation-triangle-fill',
      default: 'bi-info-circle-fill',
    };

    const toast = document.createElement('div');
    toast.className = `hs-toast toast-${type}`;
    toast.innerHTML = `
      <i class="bi ${icons[type] || icons.default}" style="font-size:17px;flex-shrink:0;"></i>
      <span style="flex:1;">${message}</span>
      <button onclick="this.parentElement.remove()" style="background:none;border:none;color:inherit;cursor:pointer;padding:2px;font-size:16px;line-height:1;opacity:0.7;">
        <i class="bi bi-x"></i>
      </button>`;

    container.appendChild(toast);

    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(10px)';
      toast.style.transition = 'all 0.22s ease';
      setTimeout(() => toast.remove(), 220);
    }, duration);
  };
  window.showToast = window.hsToast;

  /* ─── 10. Form Submit Loading State ─────────────────────────────────── */
  document.addEventListener('submit', function (e) {
    const form = e.target;
    if (e.defaultPrevented) return;
    const submitBtn = form.querySelector('[type="submit"]:not([data-no-loading])');
    if (!submitBtn) return;

    if (form.checkValidity()) {
      startProgress();
      const original = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = `<span class="hs-spinner-sm me-1"></span> ${submitBtn.dataset.loadingText || 'Memproses...'}`;

      setTimeout(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = original;
        finishProgress();
      }, 12000);
    }
  });

  /* ─── 11. Star Rating (Review Form) ─────────────────────────────────── */
  document.querySelectorAll('.hs-star-input').forEach(input => {
    input.addEventListener('change', function () {
      const ratingDisplay = document.getElementById('rating-display');
      if (ratingDisplay) {
        const labels = ['', 'Sangat Kurang', 'Kurang', 'Cukup Baik', 'Memuaskan', 'Sangat Memuaskan'];
        ratingDisplay.textContent = labels[this.value] || '';
      }
    });
  });

  /* ─── 12. Booking Quantity Controls & Live Calculator ───────────────── */
  document.addEventListener('click', function (e) {
    const btn = e.target.closest('[data-qty]');
    if (!btn) return;

    const action   = btn.dataset.qty;
    const targetId = btn.dataset.target;
    const input    = document.getElementById(targetId);
    if (!input) return;

    let val   = parseInt(input.value) || 1;
    const min = parseInt(input.min) || 1;
    const max = parseInt(input.max) || 10;

    if (action === 'plus')  val = Math.min(val + 1, max);
    if (action === 'minus') val = Math.max(val - 1, min);

    input.value = val;
    input.dispatchEvent(new Event('change', { bubbles: true }));
  });

  function recalcBookingTotal() {
    const rows = document.querySelectorAll('[data-service-row]');
    if (!rows.length) return;

    let total = 0;
    rows.forEach(row => {
      const price = parseFloat(row.dataset.price || 0);
      const qtyEl = row.querySelector('[data-service-qty]');
      const qty   = parseInt(qtyEl?.value || 1);
      const sub   = price * qty;
      total += sub;

      const subEl = row.querySelector('[data-service-subtotal]');
      if (subEl) subEl.textContent = 'Rp ' + sub.toLocaleString('id-ID');
    });

    const totalEl = document.getElementById('booking-total');
    if (totalEl) totalEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
  }

  document.addEventListener('change', function (e) {
    if (e.target.closest('[data-service-qty]')) recalcBookingTotal();
  });

  recalcBookingTotal();

  /* ─── 13. Confirm Dialogs (data-confirm) ────────────────────────────── */
  document.addEventListener('submit', function (e) {
    const form = e.target;
    const msg  = form.dataset.confirm;
    if (msg && !window.confirm(msg)) {
      e.preventDefault();
    }
  });

  document.addEventListener('click', function (e) {
    const link = e.target.closest('a[data-confirm]');
    if (link && !window.confirm(link.dataset.confirm)) {
      e.preventDefault();
    }
  });

  /* ─── 14. Password Visibility Toggle ────────────────────────────────── */
  document.querySelectorAll('[data-password-toggle]').forEach(btn => {
    btn.addEventListener('click', function () {
      const targetId = this.dataset.passwordToggle;
      const input    = document.getElementById(targetId);
      const icon     = this.querySelector('i');
      if (!input) return;
      if (input.type === 'password') {
        input.type = 'text';
        if (icon) icon.className = 'bi bi-eye-slash';
      } else {
        input.type = 'password';
        if (icon) icon.className = 'bi bi-eye';
      }
    });
  });
})();
