<!-- SECTION 2: HERO SECTION -->
<section id="home" class="relative pt-12 pb-24 md:pt-20 md:pb-32 overflow-hidden scroll-mt-24">
    <canvas id="hero-ripple-canvas" class="absolute inset-0 w-full h-full pointer-events-none" style="z-index:100;"></canvas>
    <!-- Glow background decor -->
    <div class="absolute -top-40 right-0 w-[600px] h-[600px] bg-glow-orange pointer-events-none rounded-full"></div>
    
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            
            <!-- Left Hero Content -->
            <div class="lg:col-span-7 flex flex-col items-start text-left">
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold tracking-wider text-[#E35D25] bg-[#E35D25]/10 border border-[#E35D25]/20 mb-6 uppercase">
                    ✨ Kreativitas Tanpa Batas
                </span>
                
                <h1 class="font-serif-display text-5xl md:text-7xl font-semibold tracking-tight text-[#1E1B19] leading-[1.1] mb-6">
                    Teknologi <span class="font-normal italic text-[#E35D25] font-serif-display">&</span><br>kreativitas
                </h1>
                
                <p class="text-lg text-[#1E1B19]/80 leading-relaxed mb-8 max-w-xl">
                    Jogjatouch adalah mitra teknologi dan kreatif terpercaya di Yogyakarta. Kami menghadirkan solusi perakitan hardware, maintenance sistem komputer, desain grafis premium, hingga layanan cetak (printing) berkualitas tinggi untuk mewujudkan visi dan kebutuhan Anda.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                    <a href="#layanan" class="inline-flex items-center justify-center px-8 py-4 rounded-full text-base font-semibold bg-[#1E1B19] text-white hover:bg-[#332e2c] hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 shadow-xl shadow-black/10 group">
                        Mulai Proyek
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                    <a href="#tentang" class="inline-flex items-center justify-center px-8 py-4 rounded-full text-base font-semibold border-b-2 border-transparent hover:border-[#1E1B19] text-[#1E1B19] transition-all duration-200">
                        Lihat Layanan
                    </a>
                </div>
            </div>

            <!-- Right Hero Mockup Image (Matches target illustration) -->
            <div class="lg:col-span-5 relative w-full flex items-center justify-center">
                <div class="relative w-80 h-80 md:w-112 md:h-112 flex items-center justify-center">
                    
                    <!-- Main Solid Orange Circle Background -->
                    <div class="absolute w-64 h-64 md:w-88 md:h-88 bg-gradient-to-tr from-[#E35D25] to-[#f4733e] rounded-full shadow-2xl flex items-center justify-center overflow-hidden animate-pulse" style="animation-duration: 6s;">
                        
                        <!-- Curved decorative overlay lines inside circle -->
                        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
                    </div>
                    
                    <!-- Smartphone Mockup Overlay -->
                    <div class="absolute w-36 h-64 md:w-48 md:h-88 bg-[#FBF9F6] rounded-3xl shadow-2xl border-4 border-[#1E1B19] flex flex-col justify-between p-3 rotate-12 transform hover:rotate-6 transition-all duration-500 z-10">
                        <!-- Phone Notch -->
                        <div class="w-16 h-3 bg-[#1E1B19] rounded-full mx-auto mb-4"></div>
                        
                        <!-- Content Screen (Jogjatouch Graphic) -->
                        <div class="flex-1 rounded-xl bg-gradient-to-b from-[#FFF2EC] to-[#FFE6DA] flex flex-col items-center justify-center p-3 relative overflow-hidden">
                            <!-- Inner Orange "J" Logo in phone -->
                            <div class="w-12 h-12 rounded-xl bg-[#FFFFFF] flex items-center justify-center text-white font-bold text-xl shadow-md shadow-[#E35D25]/20 group-hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('assets/logo jogja touch border white.png') }}" alt="Jogja Touch Logo" class="w-10 h-10">
                            </div>
                            <!-- Vertical text inside smartphone mockup -->
                            <div class="text-[12px] md:text-xs font-bold tracking-widest text-[#1E1B19]/70 uppercase z-10 flex flex-col items-center gap-1 font-serif-display italic mt-3">
                                <span>J</span>
                                <span>O</span>
                                <span>G</span>
                                <span>J</span>
                                <span>A</span>
                            </div>
                            <div class="text-[9px] md:text-[10px] font-semibold text-[#E35D25] tracking-widest uppercase mt-2 z-10">
                                TOUCH
                            </div>
                        </div>
                        
                        <!-- Phone Home Indicator -->
                        <div class="w-12 h-1 bg-[#1E1B19]/30 rounded-full mx-auto mt-3"></div>
                    </div>

                    <!-- White Overlay Circles (Depth and Mockup feel) -->
                    <div class="absolute top-2 left-6 w-16 h-16 md:w-20 md:h-20 bg-white/90 backdrop-blur-md rounded-full shadow-lg border border-white/40 z-20 flex items-center justify-center animate-bounce" style="animation-duration: 4s;">
                        <div class="w-3 h-3 bg-[#E35D25] rounded-full"></div>
                    </div>
                    
                    <div class="absolute bottom-6 left-80 w-16 h-16 md:w-24 md:h-24 bg-white/90 backdrop-blur-md rounded-full shadow-lg border border-white/40 z-20 flex items-center justify-center animate-bounce" style="animation-duration: 4.5s;">
                        <div class="w-3 h-3 bg-[#E35D25] rounded-full"></div>
                    </div>

                    <!-- Decorative background dots -->
                    <svg class="absolute -bottom-8 -left-8 text-[#1E1B19]/10 w-24 h-24" fill="currentColor" viewBox="0 0 100 100">
                        <rect width="100" height="100" fill="none"/>
                        <circle cx="10" cy="10" r="3" /> <circle cx="30" cy="10" r="3" /> <circle cx="50" cy="10" r="3" /> <circle cx="70" cy="10" r="3" /> <circle cx="90" cy="10" r="3" />
                        <circle cx="10" cy="30" r="3" /> <circle cx="30" cy="30" r="3" /> <circle cx="50" cy="30" r="3" /> <circle cx="70" cy="30" r="3" /> <circle cx="90" cy="30" r="3" />
                        <circle cx="10" cy="50" r="3" /> <circle cx="30" cy="50" r="3" /> <circle cx="50" cy="50" r="3" /> <circle cx="70" cy="50" r="3" /> <circle cx="90" cy="50" r="3" />
                        <circle cx="10" cy="70" r="3" /> <circle cx="30" cy="70" r="3" /> <circle cx="50" cy="70" r="3" /> <circle cx="70" cy="70" r="3" /> <circle cx="90" cy="70" r="3" />
                        <circle cx="10" cy="90" r="3" /> <circle cx="30" cy="90" r="3" /> <circle cx="50" cy="90" r="3" /> <circle cx="70" cy="90" r="3" /> <circle cx="90" cy="90" r="3" />
                    </svg>
                </div>
            </div>

        </div>

    </div>
</section>

@push('scripts')
<script>
(function () {
    const section = document.getElementById('home');
    const canvas  = document.getElementById('hero-ripple-canvas');
    const ctx     = canvas.getContext('2d');
    const rings   = [];
    let animating = false;

    function resize() {
        canvas.width  = section.offsetWidth;
        canvas.height = section.offsetHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    window.heroRippleBurst = function (btn) {
        resize();
        const sr = section.getBoundingClientRect();
        const br = btn.getBoundingClientRect();
        const cx = br.left + br.width  / 2 - sr.left;
        const cy = br.top  + br.height / 2 - sr.top;
        const maxR = Math.hypot(canvas.width, canvas.height);
        const now  = performance.now();

        for (let i = 0; i < 8; i++) {
            rings.push({
                x:         cx,
                y:         cy,
                radius:    0,
                maxR:      maxR,
                speed:     6 + Math.random() * 7,
                lw:        1.5 + Math.random() * 2.5,
                startTime: now + i * 75,
            });
        }

        if (!animating) {
            animating = true;
            requestAnimationFrame(loop);
        }
    };

    function loop(now) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        let alive = false;

        for (let i = rings.length - 1; i >= 0; i--) {
            const r = rings[i];
            if (now < r.startTime) { alive = true; continue; }

            const elapsed  = now - r.startTime;
            r.radius = r.speed * (elapsed / 16);
            const progress = Math.min(r.radius / r.maxR, 1);
            const alpha    = 0.6 * (1 - progress * progress);

            if (alpha < 0.005 || progress >= 1) { rings.splice(i, 1); continue; }
            alive = true;

            ctx.save();
            ctx.globalAlpha = alpha;
            ctx.strokeStyle = '#E35D25';
            ctx.lineWidth   = r.lw * (1 - progress * 0.55);
            ctx.beginPath();
            ctx.arc(r.x, r.y, r.radius, 0, Math.PI * 2);
            ctx.stroke();
            if (r.radius > 40) {
                ctx.globalAlpha = alpha * 0.25;
                ctx.lineWidth   = 0.8;
                ctx.beginPath();
                ctx.arc(r.x, r.y, r.radius * 0.6, 0, Math.PI * 2);
                ctx.stroke();
            }
            ctx.restore();
        }

        if (alive) {
            requestAnimationFrame(loop);
        } else {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            animating = false;
        }
    }
})();
</script>
@endpush

<!-- SECTION 3: TENTANG KAMI — Galeri coverflow mandiri (section terpisah agar scroll spy bekerja) -->
@php
    // Nama file sengaja ditulis eksplisit: 1-4 berekstensi .jpeg, 5-6 berekstensi .jpg
    $tentangImages = [
        ['file' => 'assets/tentang/1.jpeg', 'alt' => 'Servis kartu grafis GeForce GTX di meja kerja Jogjatouch',
         'title' => 'Servis Kartu Grafis',        'caption' => 'Pembersihan menyeluruh & perawatan VGA GeForce GTX, suhu kembali dingin, performa stabil.'],
        ['file' => 'assets/tentang/2.jpeg', 'alt' => 'Instalasi router MikroTik hAP lite untuk jaringan WiFi',
         'title' => 'Instalasi Jaringan MikroTik', 'caption' => 'Setup router MikroTik hAP lite untuk jaringan WiFi rumah, kantor, dan usaha.'],
        ['file' => 'assets/tentang/3.jpeg', 'alt' => 'Maintenance dan optimasi laptop ThinkPad',
         'title' => 'Maintenance Laptop',          'caption' => 'Tune-up sistem, pengecekan disk, dan optimasi performa laptop kerja.'],
        ['file' => 'assets/tentang/4.jpeg', 'alt' => 'Perbaikan hardware kartu grafis dengan obeng',
         'title' => 'Perbaikan Hardware',          'caption' => 'Bongkar-pasang kartu grafis: penggantian pasta termal & perbaikan pendingin.'],
        ['file' => 'assets/tentang/5.jpg',  'alt' => 'Pemasangan antenna tuner ICOM AT-130 di atas kapal',
         'title' => 'Instalasi Perangkat Komunikasi', 'caption' => 'Pemasangan antenna tuner ICOM AT-130 di kapal, komunikasi laut tetap andal.'],
        ['file' => 'assets/tentang/6.jpg',  'alt' => 'Kapal tunda ETI 102 lokasi proyek instalasi Jogjatouch',
         'title' => 'Proyek Lapangan Maritim',     'caption' => 'Instalasi & pengecekan sistem komunikasi di armada kapal tunda.'],
    ];
    $tentangImages = array_values(array_filter(
        $tentangImages,
        fn ($img) => file_exists(public_path($img['file']))
    ));
@endphp

<style>
    /* ── Galeri #tentang — coverflow/cascade ───────────────────────────────────
       Section setinggi SATU layar saja: scroll halaman ke bawah langsung
       melewatinya, tidak lagi dipakai untuk menggeser galeri (scroll-hijack).
       Galeri digerakkan sendiri lewat tombol panah, drag/swipe, tombol panah
       keyboard, dan autoplay saat section terlihat. Indeks aktif pecahan
       tetap menentukan posisi tiap slide (translateX/scale/opacity/z-index). */
    .tg-root {
        --tg-nav: 5.5rem;     /* navbar sticky terukur 81px di semua ukuran layar */
        --tg-gap: 2.5rem;      /* jarak judul <-> gambar */
        --tg-prog: 4rem;       /* ruang indikator progress di bawah */
        /* Cap tinggi gambar = seluruh ruang non-gambar:
           nav(88) + gap(40) + judul(56) + gap(40) + progress(64) = 288px = 18rem.
           Menjaga gambar tidak pernah terpotong maupun menyentuh judul. */
        --tg-cap: 18rem;
        --tg-active-w: 58vw;   /* lebar gambar aktif (target 55–60% viewport) */
        position: relative;
        /* WAJIB: z-index eksplisit -> section jadi stacking context sendiri,
           sehingga z-index besar milik slide (sampai 1000, di-set JS) dan
           tombol nav terkurung di dalamnya dan tidak pernah menimpa navbar
           sticky (z-50). Dulu peran ini dipegang .tg-stage yang position:
           sticky (sticky selalu bikin stacking context); sejak stage jadi
           relative, section-lah yang harus memegangnya. */
        z-index: 0;
    }

    /* Kolom: judul (alur normal, di atas) lalu galeri mengisi sisa ruang. */
    .tg-stage {
        position: relative;
        height: 100vh;
        min-height: 34rem;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .tg-viewport {
        flex: 1 1 auto;
        min-height: 0;
        position: relative;
    }

    .tg-track {
        position: absolute;
        inset: 0 0 var(--tg-prog) 0;
        cursor: grab;
        touch-action: pan-y;   /* geser vertikal tetap men-scroll halaman */
    }

    .tg-track.is-dragging {
        cursor: grabbing;
    }

    /* Tombol navigasi galeri — pengganti scroll sebagai penggerak utama. */
    .tg-nav-btn {
        position: absolute;
        top: 50%;
        /* Harus di atas SEMUA slide: JS memberi slide z-index hingga 1000
           ((10 - dist) * 100), dan .tg-track tidak membuat stacking context
           sendiri, jadi angka itu bersaing langsung dengan tombol ini.
           Nilai < 1000 membuat slide menutupi tombol -> klik tertelan. */
        z-index: 1200;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 3rem;
        height: 3rem;
        margin-top: calc(var(--tg-prog) / -2);
        border: 1px solid rgba(30, 27, 25, 0.1);
        border-radius: 999px;
        background: rgba(251, 249, 246, 0.92);
        -webkit-backdrop-filter: blur(6px);
        backdrop-filter: blur(6px);
        color: #1E1B19;
        box-shadow: 0 10px 24px -8px rgba(30, 27, 25, 0.35);
        cursor: pointer;
        transform: translateY(-50%);
        transition: background 0.2s ease, opacity 0.2s ease, transform 0.2s ease;
    }

    .tg-nav-btn:hover:not(:disabled) {
        background: #fff;
        transform: translateY(-50%) scale(1.06);
    }

    .tg-nav-btn:active:not(:disabled) {
        transform: translateY(-50%) scale(0.96);
    }

    /* Sudah mentok di ujung galeri. */
    .tg-nav-btn:disabled {
        opacity: 0.25;
        cursor: default;
    }

    .tg-nav-prev { left: 1.25rem; }
    .tg-nav-next { right: 1.25rem; }

    /* Tiap slide menutupi seluruh track & menengahkan frame-nya.
       Transform di-set JS: translate3d(px) leftmost -> geser dlm piksel asli
       (tidak ikut ter-skala), scale() rightmost -> mengecil dari titik tengah. */
    .tg-slide {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        will-change: transform, opacity;
        backface-visibility: hidden;
    }

    /* Pembungkus frame: pemilik lebar & konteks posisi untuk awan dekoratif
       yang menjorok keluar frame (frame sendiri overflow:hidden). */
    .tg-figure {
        position: relative;
        width: min(var(--tg-active-w), calc((100vh - var(--tg-cap)) * 16 / 9));
    }

    /* Frame identik untuk SEMUA slide: 16:9 persis, ukuran sama, tidak distorsi. */
    .tg-frame {
        position: relative;
        z-index: 1;
        width: 100%;
        aspect-ratio: 16 / 9;
        overflow: hidden;
        border-radius: 24px;
        background: #26221F;
        box-shadow: 0 24px 60px -12px rgba(30, 27, 25, 0.45);
    }

    .tg-frame img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    /* Peredup tetangga. Sengaja TIDAK memakai opacity pada slide-nya:
       scrim warna background di atas gambar OPAK menghasilkan warna akhir yang
       identik dengan opacity (0.5*img + 0.5*#FBF9F6), tapi saat dua slide
       bertindihan di tengah transisi gambar belakang tidak menembus gambar
       depan (efek "double exposure"). */
    .tg-frame::after {
        content: '';
        position: absolute;
        inset: 0;
        background: #FBF9F6;
        opacity: var(--tg-scrim, 0);
        pointer-events: none;
    }

    /* ── Awan dekoratif & caption per-slide ────────────────────────────────
       Awan: blob gradient blur (glow lembut) memakai palet situs — oranye
       #E35D25 / #f4733e dan cokelat tua #1E1B19 — di belakang/sekitar frame.
       Caption: overlay di tepi bawah gambar dengan scrim gradasi gelap.
       Keduanya hanya tampil di slide aktif; transisi masuk = naik dari bawah
       + fade in, transisi keluar = tertarik turun + fade out (sesuai arah
       navigasi: maju memunculkan, mundur menariknya turun). */
    .tg-cloud {
        position: absolute;
        z-index: 0;
        pointer-events: none;
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.6s ease, transform 0.6s cubic-bezier(0.22, 0.9, 0.3, 1);
        will-change: transform, opacity;
    }

    .tg-cloud-a {
        width: 46%;
        aspect-ratio: 1.15;
        left: -9%;
        bottom: -16%;
        border-radius: 58% 42% 55% 45% / 52% 58% 42% 48%;
        background: radial-gradient(closest-side, rgba(227, 93, 37, 0.65), rgba(244, 115, 62, 0.30) 55%, transparent 100%);
        filter: blur(46px);
    }

    .tg-cloud-b {
        width: 34%;
        aspect-ratio: 1;
        left: -11%;
        top: 4%;
        border-radius: 45% 55% 60% 40% / 55% 45% 55% 45%;
        background: radial-gradient(closest-side, rgba(244, 115, 62, 0.50), rgba(30, 27, 25, 0.22) 68%, transparent 100%);
        filter: blur(54px);
    }

    .tg-cloud-c {
        width: 30%;
        aspect-ratio: 1.2;
        right: -8%;
        bottom: -14%;
        border-radius: 52% 48% 45% 55% / 48% 52% 58% 42%;
        background: radial-gradient(closest-side, rgba(30, 27, 25, 0.45), rgba(227, 93, 37, 0.20) 60%, transparent 100%);
        filter: blur(42px);
    }

    .tg-caption {
        position: absolute;
        z-index: 2;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 3.25rem 1.75rem 1.5rem;
        background: linear-gradient(to top, rgba(30, 27, 25, 0.86) 0%, rgba(30, 27, 25, 0.55) 55%, rgba(30, 27, 25, 0) 100%);
        text-align: left;
        opacity: 0;
        transform: translateY(28px);
        transition: opacity 0.55s ease, transform 0.55s cubic-bezier(0.22, 0.9, 0.3, 1);
        will-change: transform, opacity;
    }

    .tg-caption-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: #FBF9F6;
        line-height: 1.3;
        margin-bottom: 0.25rem;
    }

    .tg-caption-text {
        font-size: 0.8125rem;
        line-height: 1.55;
        color: rgba(251, 249, 246, 0.78);
        max-width: 60ch;
    }

    /* Slide aktif: elemen naik ke posisinya. Delay bertingkat memberi kesan
       awan "tumbuh" satu per satu lalu caption menyusul. Delay hanya di state
       aktif — saat keluar semua turun serempak tanpa menunggu. */
    .tg-slide.is-active .tg-cloud,
    .tg-slide.is-active .tg-caption {
        opacity: 1;
        transform: translateY(0);
    }

    .tg-slide.is-active .tg-cloud-b { transition-delay: 0.07s; }
    .tg-slide.is-active .tg-cloud-c { transition-delay: 0.14s; }
    .tg-slide.is-active .tg-caption { transition-delay: 0.1s; }

    @media (prefers-reduced-motion: reduce) {
        .tg-cloud,
        .tg-caption {
            transition: opacity 0.4s ease;
            transform: none;
        }
    }

    /* Gradasi + blur di tepi atas/bawah -> menyatu ke background halaman */
    .tg-fade {
        position: absolute;
        left: 0;
        right: 0;
        height: 18vh;
        z-index: 20;
        pointer-events: none;
    }

    .tg-fade-top {
        top: 0;
        background: linear-gradient(to bottom, #FBF9F6 0%, rgba(251, 249, 246, 0.82) 38%, rgba(251, 249, 246, 0) 100%);
        -webkit-backdrop-filter: blur(6px);
        backdrop-filter: blur(6px);
        -webkit-mask-image: linear-gradient(to bottom, #000 0%, #000 30%, transparent 100%);
        mask-image: linear-gradient(to bottom, #000 0%, #000 30%, transparent 100%);
    }

    .tg-fade-bottom {
        bottom: 0;
        background: linear-gradient(to top, #FBF9F6 0%, rgba(251, 249, 246, 0.82) 38%, rgba(251, 249, 246, 0) 100%);
        -webkit-backdrop-filter: blur(6px);
        backdrop-filter: blur(6px);
        -webkit-mask-image: linear-gradient(to top, #000 0%, #000 30%, transparent 100%);
        mask-image: linear-gradient(to top, #000 0%, #000 30%, transparent 100%);
    }

    /* Judul: elemen alur normal di atas galeri (bukan overlay). Teks polos,
       tanpa text-shadow — tidak pernah bertumpuk dengan gambar.
       position/z-index dipakai HANYA agar judul tidak tenggelam di belakang
       .tg-fade-top (z-index 20) yang ber-backdrop-filter blur. */
    .tg-head {
        position: relative;
        z-index: 30;
        flex: 0 0 auto;
        padding: calc(var(--tg-nav) + var(--tg-gap)) 1.5rem var(--tg-gap);
        text-align: center;
    }

    .tg-progress {
        position: absolute;
        bottom: 1.75rem;
        left: 0;
        right: 0;
        z-index: 30;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.875rem;
    }

    .tg-bar {
        position: relative;
        width: 160px;
        height: 3px;
        border-radius: 999px;
        background: rgba(30, 27, 25, 0.12);
        overflow: hidden;
    }

    .tg-bar-fill {
        position: absolute;
        inset: 0;
        border-radius: 999px;
        background: #E35D25;
        transform: scaleX(0);
        transform-origin: left center;
    }

    .tg-count {
        font-size: 0.6875rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        color: rgba(30, 27, 25, 0.5);
        font-variant-numeric: tabular-nums;
    }

    /* Portrait / layar sempit: TETAP coverflow, hanya ukurannya yang menyesuaikan.
       --tg-nav & --tg-cap sengaja TIDAK di-override: navbar sama-sama 81px dan
       gaya judul harus seragam di semua ukuran layar. */
    @media (max-width: 767px) {
        .tg-root {
            --tg-active-w: 88vw;
        }

        .tg-frame {
            border-radius: 16px;
        }

        /* Blur lebih ringan di layar kecil agar komposit tetap enteng. */
        .tg-cloud-a { filter: blur(30px); }
        .tg-cloud-b { filter: blur(36px); }
        .tg-cloud-c { filter: blur(28px); }

        .tg-caption {
            padding: 2.25rem 1rem 0.875rem;
        }

        .tg-caption-title {
            font-size: 0.9375rem;
        }

        .tg-caption-text {
            font-size: 0.6875rem;
            line-height: 1.45;
        }

        .tg-fade {
            height: 14vh;
        }

        .tg-progress {
            bottom: 1.25rem;
        }

        .tg-nav-btn {
            width: 2.25rem;
            height: 2.25rem;
        }

        .tg-nav-prev { left: 0.5rem; }
        .tg-nav-next { right: 0.5rem; }
    }
</style>

<section id="tentang" class="tg-root bg-[#FBF9F6] scroll-mt-24">
    <div class="tg-stage">

        <div class="tg-head">
            <span class="tg-eyebrow text-xs font-bold text-[#E35D25] tracking-widest uppercase block mb-1">TENTANG KAMI</span>
            <h2 class="font-serif-display text-xl md:text-4xl font-semibold tracking-tight text-[#1E1B19] leading-none">
                Pekerjaan yang telah <span class="italic text-[#E35D25] font-serif-display">kami selesaikan.</span>
            </h2>
        </div>

        <div class="tg-viewport">
            <div class="tg-track" data-tg-track>
                @foreach($tentangImages as $index => $img)
                    <div class="tg-slide">
                        <div class="tg-figure">
                            <div class="tg-cloud tg-cloud-a" aria-hidden="true"></div>
                            <div class="tg-cloud tg-cloud-b" aria-hidden="true"></div>
                            <div class="tg-cloud tg-cloud-c" aria-hidden="true"></div>
                            <div class="tg-frame">
                                <img src="{{ asset($img['file']) }}"
                                     alt="{{ $img['alt'] }}"
                                     loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                     decoding="async"
                                     draggable="false">
                                @if(!empty($img['title']) || !empty($img['caption']))
                                    <div class="tg-caption">
                                        @if(!empty($img['title']))
                                            <h3 class="tg-caption-title font-serif-display">{{ $img['title'] }}</h3>
                                        @endif
                                        @if(!empty($img['caption']))
                                            <p class="tg-caption-text">{{ $img['caption'] }}</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if(count($tentangImages) > 1)
            <button type="button" class="tg-nav-btn tg-nav-prev" data-tg-prev aria-label="Gambar sebelumnya">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <button type="button" class="tg-nav-btn tg-nav-next" data-tg-next aria-label="Gambar berikutnya">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            @endif
        </div>

        <div class="tg-fade tg-fade-top"></div>
        <div class="tg-fade tg-fade-bottom"></div>

        <div class="tg-progress">
            <div class="tg-bar">
                <div class="tg-bar-fill" data-tg-fill></div>
            </div>
            <span class="tg-count" data-tg-count>01 / {{ str_pad(count($tentangImages), 2, '0', STR_PAD_LEFT) }}</span>
        </div>

    </div>
</section>

@push('scripts')
<script>
(function () {
    const root  = document.getElementById('tentang');
    if (!root) return;

    const track = root.querySelector('[data-tg-track]');
    const fill  = root.querySelector('[data-tg-fill]');
    const label = root.querySelector('[data-tg-count]');
    const count = track ? track.children.length : 0;
    if (!track || count < 2) return;

    const slides = Array.from(track.children);
    const total  = String(count).padStart(2, '0');

    // Coverflow: jarak antar-slide relatif lebar frame aktif. < 1 supaya
    // tetangga tertutup sebagian oleh slide aktif -> terkesan menumpuk.
    const SPACING_RATIO = 0.66;
    const SCALE_DROP    = 0.22;  // tetangga -> skala 0.78
    const SCRIM_MAX     = 0.5;   // tetangga -> seredup opacity 0.5, tanpa tembus pandang

    const AUTOPLAY_MS = 4500;

    const prevBtn = root.querySelector('[data-tg-prev]');
    const nextBtn = root.querySelector('[data-tg-next]');

    let spacing = 0;   // piksel, diturunkan dari lebar frame (offsetWidth, bebas transform)
    let index   = 0;   // slide aktif (integer)
    let target  = 0;   // progress 0..1 tujuan
    let current = 0;   // progress ter-render (di-lerp agar halus)
    let rafId   = null;
    let lastIdx = -1;

    function measure() {
        const frame = track.querySelector('.tg-frame');
        spacing = frame ? frame.offsetWidth * SPACING_RATIO : 0;
    }

    function clamp(v, lo, hi) {
        return Math.min(Math.max(v, lo), hi);
    }

    // Galeri tidak lagi digerakkan scroll halaman; indeks -> progress 0..1.
    function goTo(i, { user = true } = {}) {
        index  = clamp(Math.round(i), 0, count - 1);
        target = index / (count - 1);
        if (user) restartAutoplay();
        syncButtons();
        schedule();
    }

    // Mentok di ujung (tidak melingkar): di gambar 1 tidak bisa mundur lagi,
    // di gambar terakhir tidak bisa maju lagi. goTo() sudah meng-clamp;
    // syncButtons() memberi tanda visual tombol yang sudah mentok.
    function step(dir) {
        goTo(index + dir);
    }

    function syncButtons() {
        if (prevBtn) prevBtn.disabled = index === 0;
        if (nextBtn) nextBtn.disabled = index === count - 1;
    }

    function render(p) {
        const active = p * (count - 1);   // indeks aktif pecahan

        for (let i = 0; i < count; i++) {
            const offset = i - active;
            const dist   = Math.abs(offset);
            const scale  = 1 - Math.min(dist, 1) * SCALE_DROP;
            const scrim  = Math.min(dist, 1) * SCRIM_MAX;
            // Slide tetap opak sampai jarak 1 (tetangga), baru menghilang di jarak 2.
            const opacity = 1 - Math.min(Math.max(dist - 1, 0), 1);
            const el = slides[i];

            // translate3d leftmost -> px asli (tak ikut ter-skala); scale rightmost.
            el.style.transform = `translate3d(${(offset * spacing).toFixed(2)}px, 0, 0) scale(${scale.toFixed(4)})`;
            el.style.opacity   = opacity.toFixed(3);
            el.style.setProperty('--tg-scrim', scrim.toFixed(3));
            // Resolusi tinggi supaya yang lebih dekat ke aktif selalu di depan;
            // saat seri (tepat di tengah dua gambar) urutan DOM yang menentukan.
            el.style.zIndex = String(Math.round((10 - dist) * 100));
        }

        fill.style.transform = `scaleX(${p.toFixed(4)})`;

        const idx = Math.round(active);
        if (idx !== lastIdx) {
            // Ganti slide aktif: caption & awan slide lama tertarik turun
            // (transisi keluar), milik slide baru naik dari bawah (transisi
            // masuk). Perilaku dua arah ini murni dari state CSS .is-active.
            if (lastIdx >= 0 && slides[lastIdx]) slides[lastIdx].classList.remove('is-active');
            if (slides[idx]) slides[idx].classList.add('is-active');
            lastIdx = idx;
            label.textContent = `${String(idx + 1).padStart(2, '0')} / ${total}`;
        }
    }

    // Lerp: cascade mengalir kontinu mengikuti scroll, tanpa patah-patah
    function tick() {
        current += (target - current) * 0.14;

        if (Math.abs(target - current) < 0.00015) {
            current = target;
            render(current);
            rafId = null;
            return;
        }

        render(current);
        rafId = requestAnimationFrame(tick);
    }

    function schedule() {
        if (rafId === null) rafId = requestAnimationFrame(tick);
    }

    // ── Autoplay ──────────────────────────────────────────────────────────
    // Hanya berjalan saat galeri terlihat; berhenti saat hover/drag/tab lain,
    // dan menghormati prefers-reduced-motion.
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    let autoplayId = null;
    let inView     = false;
    let paused     = false;

    function stopAutoplay() {
        if (autoplayId !== null) {
            clearInterval(autoplayId);
            autoplayId = null;
        }
    }

    function restartAutoplay() {
        stopAutoplay();
        if (!inView || paused || reduceMotion.matches || document.hidden) return;
        autoplayId = setInterval(function () {
            // Ikut aturan "mentok": berhenti di gambar terakhir, tidak memutar
            // balik ke gambar pertama.
            if (index >= count - 1) { stopAutoplay(); return; }
            goTo(index + 1, { user: false });
        }, AUTOPLAY_MS);
    }

    function setPaused(v) {
        paused = v;
        restartAutoplay();
    }

    if ('IntersectionObserver' in window) {
        new IntersectionObserver(function (entries) {
            inView = entries[0].isIntersecting;
            restartAutoplay();
        }, { threshold: 0.35 }).observe(root);
    } else {
        inView = true;
    }

    document.addEventListener('visibilitychange', restartAutoplay);
    root.addEventListener('mouseenter', function () { setPaused(true); });
    root.addEventListener('mouseleave', function () { setPaused(false); });
    root.addEventListener('focusin',    function () { setPaused(true); });
    root.addEventListener('focusout',   function () { setPaused(false); });

    // ── Kontrol ───────────────────────────────────────────────────────────
    if (prevBtn) prevBtn.addEventListener('click', function () { step(-1); });
    if (nextBtn) nextBtn.addEventListener('click', function () { step(1); });

    root.addEventListener('keydown', function (e) {
        if (e.key === 'ArrowRight')     { step(1);  e.preventDefault(); }
        else if (e.key === 'ArrowLeft') { step(-1); e.preventDefault(); }
    });

    // Drag/swipe horizontal. touch-action: pan-y menjaga gerakan vertikal
    // tetap men-scroll halaman, jadi jari ke bawah tidak pernah tertahan.
    let dragId = null, dragX = 0, dragStart = 0, dragged = false;

    track.addEventListener('pointerdown', function (e) {
        if (e.button !== undefined && e.button !== 0) return;
        dragId    = e.pointerId;
        dragX     = e.clientX;
        dragStart = target;
        dragged   = false;
        setPaused(true);
        track.classList.add('is-dragging');
        track.setPointerCapture(dragId);
    });

    track.addEventListener('pointermove', function (e) {
        if (dragId !== e.pointerId || spacing <= 0) return;
        const dx = e.clientX - dragX;
        if (Math.abs(dx) > 4) dragged = true;
        target = clamp(dragStart - dx / (spacing * (count - 1)), 0, 1);
        schedule();
    });

    function endDrag(e) {
        if (dragId !== e.pointerId) return;
        track.releasePointerCapture(dragId);
        track.classList.remove('is-dragging');
        dragId = null;
        // Snap ke slide terdekat; kalau cuma klik (tanpa geser) posisi tetap.
        if (dragged) goTo(target * (count - 1));
        setPaused(false);
    }

    track.addEventListener('pointerup', endDrag);
    track.addEventListener('pointercancel', endDrag);
    track.addEventListener('dragstart', function (e) { e.preventDefault(); });

    // Coverflow aktif di semua ukuran layar; resize hanya mengukur ulang spacing.
    function reset() {
        if (rafId !== null) {
            cancelAnimationFrame(rafId);
            rafId = null;
        }

        measure();
        target = current = index / (count - 1);
        syncButtons();
        render(current);
    }

    window.addEventListener('resize', reset, { passive: true });

    // Lebar frame ikut font/gambar yang baru selesai dimuat -> ukur ulang.
    window.addEventListener('load', reset);

    reset();
})();
</script>
@endpush
