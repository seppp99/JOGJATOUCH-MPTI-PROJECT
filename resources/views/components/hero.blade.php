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

<!-- SECTION 3: TENTANG KAMI — Galeri horizontal scroll-hijack (section terpisah agar scroll spy bekerja) -->
@php
    // Nama file sengaja ditulis eksplisit: 1-4 berekstensi .jpeg, 5-6 berekstensi .jpg
    $tentangImages = [
        ['file' => 'assets/tentang/1.jpeg', 'alt' => 'Dokumentasi pekerjaan Jogjatouch 1'],
        ['file' => 'assets/tentang/2.jpeg', 'alt' => 'Dokumentasi pekerjaan Jogjatouch 2'],
        ['file' => 'assets/tentang/3.jpeg', 'alt' => 'Dokumentasi pekerjaan Jogjatouch 3'],
        ['file' => 'assets/tentang/4.jpeg', 'alt' => 'Dokumentasi pekerjaan Jogjatouch 4'],
        ['file' => 'assets/tentang/5.jpg',  'alt' => 'Dokumentasi pekerjaan Jogjatouch 5'],
        ['file' => 'assets/tentang/6.jpg',  'alt' => 'Dokumentasi pekerjaan Jogjatouch 6'],
    ];
    $tentangImages = array_values(array_filter(
        $tentangImages,
        fn ($img) => file_exists(public_path($img['file']))
    ));
@endphp

<style>
    /* ── Galeri #tentang — coverflow/cascade ───────────────────────────────────
       Teknik: spacer tinggi (N x 100vh) + stage sticky. Scroll native tidak
       diblokir; posisi scroll di dalam spacer jadi "indeks aktif" pecahan, lalu
       tiap slide diposisikan dari jaraknya ke indeks itu (translateX/scale/
       opacity/z-index). Scroll balik ke atas otomatis memutar mundur. */
    .tg-root {
        --tg-count: {{ max(count($tentangImages), 1) }};
        --tg-nav: 5.5rem;      /* navbar sticky terukur 81px di semua ukuran layar */
        --tg-gap: 2.5rem;      /* jarak judul <-> gambar */
        --tg-prog: 4rem;       /* ruang indikator progress di bawah */
        /* Cap tinggi gambar = seluruh ruang non-gambar:
           nav(88) + gap(40) + judul(56) + gap(40) + progress(64) = 288px = 18rem.
           Menjaga gambar tidak pernah terpotong maupun menyentuh judul. */
        --tg-cap: 18rem;
        --tg-active-w: 58vw;   /* lebar gambar aktif (target 55–60% viewport) */
        position: relative;
        height: calc(var(--tg-count) * 100vh);
    }

    /* Kolom: judul (alur normal, di atas) lalu galeri mengisi sisa ruang. */
    .tg-stage {
        position: sticky;
        top: 0;
        height: 100vh;
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
    }

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

    /* Frame identik untuk SEMUA slide: 16:9 persis, ukuran sama, tidak distorsi. */
    .tg-frame {
        position: relative;
        width: min(var(--tg-active-w), calc((100vh - var(--tg-cap)) * 16 / 9));
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

        .tg-fade {
            height: 14vh;
        }

        .tg-progress {
            bottom: 1.25rem;
        }
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
                        <div class="tg-frame">
                            <img src="{{ asset($img['file']) }}"
                                 alt="{{ $img['alt'] }}"
                                 loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                 decoding="async"
                                 draggable="false">
                        </div>
                    </div>
                @endforeach
            </div>
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

    let spacing = 0;   // piksel, diturunkan dari lebar frame (offsetWidth, bebas transform)
    let target  = 0;   // progress 0..1 sesuai posisi scroll
    let current = 0;   // progress ter-render (di-lerp agar halus)
    let rafId   = null;
    let lastIdx = -1;

    function measure() {
        const frame = track.querySelector('.tg-frame');
        spacing = frame ? frame.offsetWidth * SPACING_RATIO : 0;
    }

    // Progress scroll di dalam spacer -> 0..1
    function readProgress() {
        const max = root.offsetHeight - window.innerHeight;
        if (max <= 0) return 0;
        const scrolled = -root.getBoundingClientRect().top;
        return Math.min(Math.max(scrolled / max, 0), 1);
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

    function onScroll() {
        target = readProgress();
        schedule();
    }

    // Coverflow aktif di semua ukuran layar; resize hanya mengukur ulang spacing.
    function reset() {
        if (rafId !== null) {
            cancelAnimationFrame(rafId);
            rafId = null;
        }

        measure();
        target = current = readProgress();
        render(current);
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', reset, { passive: true });

    // Lebar frame ikut font/gambar yang baru selesai dimuat -> ukur ulang.
    window.addEventListener('load', reset);

    reset();
})();
</script>
@endpush
