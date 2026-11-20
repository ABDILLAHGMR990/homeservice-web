<footer class="hs-footer">
  <div class="hs-container">
    <div class="hs-footer-top">
      <!-- Column 1: Brand Info -->
      <div class="hs-footer-brand">
        <div class="hs-brand-logo" style="color: #FFFFFF;">
          <div class="hs-brand-icon" style="background-color: #F59E0B; color: #142B49;">
            <i class="bi bi-house-gear-fill"></i>
          </div>
          <div>Home<span style="color: #F59E0B;">Service</span></div>
        </div>
        <p>
          <strong>Your Home, Our Service.</strong><br>
          Platform digital terpercaya yang mempertemukan pemilik rumah tangga dengan teknisi profesional bersertifikat. Layanan cepat, harga transparan, dan garansi resmi.
        </p>
        <div style="display: flex; gap: 12px; margin-top: 20px;">
          <a href="#" class="hs-btn hs-btn-ghost hs-btn-sm" style="color: #FFFFFF; background: rgba(255,255,255,0.08); border-radius: 50%; width: 36px; height: 36px; padding: 0;" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="hs-btn hs-btn-ghost hs-btn-sm" style="color: #FFFFFF; background: rgba(255,255,255,0.08); border-radius: 50%; width: 36px; height: 36px; padding: 0;" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="hs-btn hs-btn-ghost hs-btn-sm" style="color: #FFFFFF; background: rgba(255,255,255,0.08); border-radius: 50%; width: 36px; height: 36px; padding: 0;" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
          <a href="#" class="hs-btn hs-btn-ghost hs-btn-sm" style="color: #FFFFFF; background: rgba(255,255,255,0.08); border-radius: 50%; width: 36px; height: 36px; padding: 0;" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>

      <!-- Column 2: Kategori Populer -->
      <div>
        <h4 class="hs-footer-heading">Kategori Populer</h4>
        <ul class="hs-footer-links">
          <li><a href="{{ route('public.services.index', ['category' => 'service-ac']) }}" class="hs-footer-link">Service & Cuci AC</a></li>
          <li><a href="{{ route('public.services.index', ['category' => 'perbaikan-listrik']) }}" class="hs-footer-link">Perbaikan Listrik & Lampu</a></li>
          <li><a href="{{ route('public.services.index', ['category' => 'plumbing']) }}" class="hs-footer-link">Plumbing & Pipa Bocor</a></li>
          <li><a href="{{ route('public.services.index', ['category' => 'cleaning-service']) }}" class="hs-footer-link">Deep Cleaning & Vakum</a></li>
          <li><a href="{{ route('public.services.index', ['category' => 'tukang-bangunan']) }}" class="hs-footer-link">Tukang Bangunan & Renovasi</a></li>
          <li><a href="{{ route('public.services.index', ['category' => 'pengecatan-rumah']) }}" class="hs-footer-link">Pengecatan Tembok Rumah</a></li>
        </ul>
      </div>

      <!-- Column 3: Bantuan & Perusahaan -->
      <div>
        <h4 class="hs-footer-heading">Bantuan & Legal</h4>
        <ul class="hs-footer-links">
          <li><a href="{{ route('public.how-it-works') }}" class="hs-footer-link">Cara Kerja & Pemesanan</a></li>
          <li><a href="{{ route('public.about') }}" class="hs-footer-link">Tentang HomeService</a></li>
          <li><a href="{{ route('public.faq') }}" class="hs-footer-link">Pusat Bantuan & FAQ</a></li>
          <li><a href="{{ route('public.contact') }}" class="hs-footer-link">Hubungi Kami</a></li>
          <li><a href="{{ route('public.terms') }}" class="hs-footer-link">Syarat & Ketentuan</a></li>
          <li><a href="{{ route('public.privacy') }}" class="hs-footer-link">Kebijakan Privasi</a></li>
        </ul>
      </div>

      <!-- Column 4: Hotline & Jaminan -->
      <div>
        <h4 class="hs-footer-heading">Hubungi Operasional</h4>
        <div style="font-size: 0.875rem; color: #93A6C0; line-height: 1.8;">
          <p><i class="bi bi-geo-alt-fill" style="color: #F59E0B; margin-right: 6px;"></i> Sudirman Central Business District, Jakarta Selatan</p>
          <p><i class="bi bi-telephone-fill" style="color: #F59E0B; margin-right: 6px;"></i> 0800-1-HOMESERVICE (Bebas Pulsa)</p>
          <p><i class="bi bi-envelope-fill" style="color: #F59E0B; margin-right: 6px;"></i> bantuan@homeservice.id</p>
          <div style="margin-top: 16px; padding: 12px; background: rgba(255,255,255,0.06); border-radius: 8px; border: 1px solid rgba(255,255,255,0.1);">
            <div style="font-weight: 600; color: #FFFFFF; font-size: 0.8125rem;"><i class="bi bi-shield-lock-fill" style="color: #16A36A;"></i> Garansi Pelayanan</div>
            <div style="font-size: 0.75rem; color: #9AA4B2; margin-top: 4px;">Pengerjaan ulang gratis apabila terjadi kerusakan dalam masa garansi 14 hari.</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bottom Copyright -->
    <div class="hs-footer-bottom">
      <div>&copy; {{ date('Y') }} HomeService Indonesia. Hak Cipta Dilindungi Undang-Undang.</div>
      <div style="display: flex; gap: 20px;">
        <span>Standar ISO 9001:2015</span>
        <span>Enkripsi 256-bit SSL</span>
        <span>Payment Gateway Terdaftar BI</span>
      </div>
    </div>
  </div>
</footer>
