<!-- SECTION 5: FOUR PILLARS SERVICES -->
<section id="layanan" class="py-24 md:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        
        <!-- Section Title Grid -->
        <div class="text-center mb-16">
            <h2 class="font-serif-display text-4xl md:text-5xl font-semibold text-[#1E1B19] leading-tight">
                Solusi lengkap, <span class="italic text-[#E35D25]">satu pintu.</span>
            </h2>
            <p class="text-[#1E1B19]/60 text-sm mt-4 max-w-md mx-auto leading-relaxed">
                Pilih layanan yang Anda butuhkan, kalkulator estimasi di bawah akan membantu memperkirakan biaya sebelum Anda memesan.
            </p>
        </div>


        <!-- 4 Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            
    <!-- Card 1 Pemasangan WiFi -->
    <a href="{{ route('layanan.show', 'pemasangan-wifi') }}" class="group block glow-card rounded-[20px] overflow-hidden">
      <div class="relative h-[260px] rounded-t-[20px] bg-[#26221F] text-white overflow-hidden flex items-center justify-center text-center px-8 transition-transform duration-300 group-hover:-translate-y-1">
        <!-- Spotlight Glow Overlay -->
        <div class="pointer-events-none absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-0 bg-[radial-gradient(circle_220px_at_var(--x,_50%)_var(--y,_50%),_rgba(227,93,37,0.25)_0%,_transparent_100%)]"></div>
        
        <span class="absolute top-4 right-5 text-[44px] font-serif font-medium leading-none text-white/15 z-10">01</span>
        <p class="absolute top-12 left-1/2 -translate-x-1/2 text-[10px] tracking-[0.35em] uppercase text-white/60 z-10">
          Network
        </p>
        <h3 class="font-serif text-[30px] leading-[1.05] font-medium z-10">
          Pemasangan<br>WiFi
        </h3>
        <span class="absolute bottom-4 left-5 text-[10px] tracking-[0.35em] uppercase text-white/25 z-10">
          Network
        </span>
      </div>

      <div class="rounded-b-[20px] bg-white border border-t-0 border-[#eee] px-5 py-4 min-h-[132px]">
        <p class="text-[10px] font-bold tracking-[0.22em] uppercase text-[#d58a58] mb-2">
          Paling Sering Dipesan
        </p>
        <p class="text-[16px] font-semibold text-[#1f1b18] mb-2">
          WiFi untuk rumah & kantor
        </p>
        <p class="text-[12px] leading-6 text-[#7a746f]">
          Instalasi access point, penarikan kabel, setting router, coverage test menyeluruh di lokasi.
        </p>
      </div>
    </a>

    <!-- Card 2 Network Analyst -->
    <a href="{{ route('layanan.show', 'network-analyst') }}" class="group block glow-card rounded-[20px] overflow-hidden">
      <div class="relative h-[260px] rounded-t-[20px] bg-gradient-to-b from-[#ff9950] to-[#ff8740] text-white overflow-hidden flex items-center justify-center text-center px-8 transition-transform duration-300 group-hover:-translate-y-1">
        <!-- Spotlight Glow Overlay -->
        <div class="pointer-events-none absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-0 bg-[radial-gradient(circle_220px_at_var(--x,_50%)_var(--y,_50%),_rgba(255,255,255,0.38)_0%,_transparent_100%)]"></div>

        <span class="absolute top-4 right-5 text-[44px] font-serif font-medium leading-none text-white/15 z-10">02</span>
        <p class="absolute top-12 left-1/2 -translate-x-1/2 text-[10px] tracking-[0.35em] uppercase text-white/65 z-10">
          Analyst
        </p>
        <h3 class="font-serif italic text-[30px] leading-[1.05] font-medium z-10">
          Network<br>Analyst
        </h3>
        <span class="absolute bottom-4 left-5 text-[10px] tracking-[0.35em] uppercase text-white/25 z-10">
          Analyst
        </span>
      </div>

      <div class="rounded-b-[20px] bg-white border border-t-0 border-[#eee] px-5 py-4 min-h-[132px]">
        <p class="text-[10px] font-bold tracking-[0.22em] uppercase text-[#d58a58] mb-2">
          Untuk Korporasi
        </p>
        <p class="text-[16px] font-semibold text-[#1f1b18] mb-2">
          Audit & optimasi jaringan
        </p>
        <p class="text-[12px] leading-6 text-[#7a746f]">
          Analisis performa, perencanaan topologi, setup Mikrotik, VLAN, dan keamanan jaringan.
        </p>
      </div>
    </a>

    <!-- Card 3 Network Maintenance -->
    <a href="{{ route('layanan.show', 'perawatan-rutin') }}" class="group block glow-card rounded-[20px] overflow-hidden">
      <div class="relative h-[260px] rounded-t-[20px] bg-[#F6E9DE] text-[#1f1b18] overflow-hidden flex items-center justify-center text-center px-8 transition-transform duration-300 group-hover:-translate-y-1">
        <!-- Spotlight Glow Overlay -->
        <div class="pointer-events-none absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-0 bg-[radial-gradient(circle_220px_at_var(--x,_50%)_var(--y,_50%),_rgba(227,93,37,0.18)_0%,_transparent_100%)]"></div>

        <span class="absolute top-4 right-5 text-[44px] font-serif font-medium leading-none text-[#1f1b18]/10 z-10">03</span>
        <p class="absolute top-12 left-1/2 -translate-x-1/2 text-[10px] tracking-[0.35em] uppercase text-[#8a7668] z-10">
          Maintenance
        </p>
        <h3 class="font-serif text-[30px] leading-[1.05] font-medium z-10">
          Perawatan<br>Rutin
        </h3>
        <span class="absolute bottom-4 left-5 text-[10px] tracking-[0.35em] uppercase text-[#1f1b18]/20 z-10">
          Care
        </span>
      </div>

      <div class="rounded-b-[20px] bg-white border border-t-0 border-[#eee] px-5 py-4 min-h-[132px]">
        <p class="text-[10px] font-bold tracking-[0.22em] uppercase text-[#d58a58] mb-2">
          Berkala
        </p>
        <p class="text-[16px] font-semibold text-[#1f1b18] mb-2">
          Maintenance bulanan
        </p>
        <p class="text-[12px] leading-6 text-[#7a746f]">
          Pengecekan rutin, cleaning, update firmware, laporan kondisi perangkat secara berkala.
        </p>
      </div>
    </a>

    <!-- Card 4 Hardware Specialist -->
    <a href="{{ route('layanan.show', 'rakit-pc') }}" class="group block glow-card rounded-[20px] overflow-hidden">
      <div class="relative h-[260px] rounded-t-[20px] bg-[#26221F] text-white overflow-hidden flex items-center justify-center text-center px-8 transition-transform duration-300 group-hover:-translate-y-1">
        <!-- Spotlight Glow Overlay -->
        <div class="pointer-events-none absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-0 bg-[radial-gradient(circle_220px_at_var(--x,_50%)_var(--y,_50%),_rgba(227,93,37,0.25)_0%,_transparent_100%)]"></div>

        <span class="absolute top-4 right-5 text-[44px] font-serif font-medium leading-none text-white/15 z-10">04</span>
        <p class="absolute top-12 left-1/2 -translate-x-1/2 text-[10px] tracking-[0.35em] uppercase text-white/60 z-10">
          Hardware
        </p>
        <h3 class="font-serif text-[30px] leading-[1.05] font-medium z-10">
          Rakit &amp;<br>Service PC
        </h3>
        <span class="absolute bottom-4 left-5 text-[10px] tracking-[0.35em] uppercase text-white/25 z-10">
          Hardware
        </span>
      </div>

      <div class="rounded-b-[20px] bg-white border border-t-0 border-[#eee] px-5 py-4 min-h-[132px]">
        <p class="text-[10px] font-bold tracking-[0.22em] uppercase text-[#d58a58] mb-2">
          Custom Build
        </p>
        <p class="text-[16px] font-semibold text-[#1f1b18] mb-2">
          PC gaming, kerja, & workstation
        </p>
        <p class="text-[12px] leading-6 text-[#7a746f]">
          Konsultasi spek, rakit, instalasi OS + software, dan troubleshooting perangkat yang bermasalah.
        </p>
      </div>
    </a>

    <!-- Card 5 Desain Grafis -->
    <a href="{{ route('layanan.show', 'desain-grafis') }}" class="group block glow-card rounded-[20px] overflow-hidden">
      <div class="relative h-[260px] rounded-t-[20px] bg-gradient-to-b from-[#ff9950] to-[#ff8740] text-white overflow-hidden flex items-center justify-center text-center px-8 transition-transform duration-300 group-hover:-translate-y-1">
        <!-- Spotlight Glow Overlay -->
        <div class="pointer-events-none absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-0 bg-[radial-gradient(circle_220px_at_var(--x,_50%)_var(--y,_50%),_rgba(255,255,255,0.35)_0%,_transparent_100%)]"></div>

        <span class="absolute top-4 right-5 text-[44px] font-serif font-medium leading-none text-white/15 z-10">05</span>
        <p class="absolute top-12 left-1/2 -translate-x-1/2 text-[10px] tracking-[0.35em] uppercase text-white/65 z-10">
          Creative
        </p>
        <h3 class="font-serif italic text-[30px] leading-[1.05] font-medium z-10">
          Desain<br>Grafis
        </h3>
        <span class="absolute bottom-4 left-5 text-[10px] tracking-[0.35em] uppercase text-white/25 z-10">
          Design
        </span>
      </div>

      <div class="rounded-b-[20px] bg-white border border-t-0 border-[#eee] px-5 py-4 min-h-[132px]">
        <p class="text-[10px] font-bold tracking-[0.22em] uppercase text-[#d58a58] mb-2">
          Branding Ready
        </p>
        <p class="text-[16px] font-semibold text-[#1f1b18] mb-2">
          Logo, banner, katalog
        </p>
        <p class="text-[12px] leading-6 text-[#7a746f]">
          Desain visual untuk kebutuhan branding, promosi, and media cetak — siap produksi.
        </p>
      </div>
    </a>

    <!-- Card 6 Printing & Cetak -->
    <a href="{{ route('layanan.show', 'printing-cetak') }}" class="group block glow-card rounded-[20px] overflow-hidden">
      <div class="relative h-[260px] rounded-t-[20px] bg-[#F6E9DE] text-[#1f1b18] overflow-hidden flex items-center justify-center text-center px-8 transition-transform duration-300 group-hover:-translate-y-1">
        <!-- Spotlight Glow Overlay -->
        <div class="pointer-events-none absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-0 bg-[radial-gradient(circle_220px_at_var(--x,_50%)_var(--y,_50%),_rgba(227,93,37,0.18)_0%,_transparent_100%)]"></div>

        <span class="absolute top-4 right-5 text-[44px] font-serif font-medium leading-none text-[#1f1b18]/10 z-10">06</span>
        <p class="absolute top-12 left-1/2 -translate-x-1/2 text-[10px] tracking-[0.35em] uppercase text-[#8a7668] z-10">
          Production
        </p>
        <h3 class="font-serif text-[30px] leading-[1.05] font-medium z-10">
          Printing<br>&amp; Cetak
        </h3>
        <span class="absolute bottom-4 left-5 text-[10px] tracking-[0.35em] uppercase text-[#1f1b18]/20 z-10">
          Print
        </span>
      </div>

      <div class="rounded-b-[20px] bg-white border border-t-0 border-[#eee] px-5 py-4 min-h-[132px]">
        <p class="text-[10px] font-bold tracking-[0.22em] uppercase text-[#d58a58] mb-2">
          Segala Ukuran
        </p>
        <p class="text-[16px] font-semibold text-[#1f1b18] mb-2">
          Banner, katalog, foto
        </p>
        <p class="text-[12px] leading-6 text-[#7a746f]">
          Layanan cetak dengan pilihan material dan finishing untuk kebutuhan personal maupun bisnis.
        </p>
      </div>
    </a>

    </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.glow-card').forEach(card => {
          const glowContainer = card.querySelector('.relative');
          card.addEventListener('mousemove', e => {
              const rect = glowContainer.getBoundingClientRect();
              const x = e.clientX - rect.left;
              const y = e.clientY - rect.top;
              glowContainer.style.setProperty('--x', `${x}px`);
              glowContainer.style.setProperty('--y', `${y}px`);
          });
      });
  });
</script>
