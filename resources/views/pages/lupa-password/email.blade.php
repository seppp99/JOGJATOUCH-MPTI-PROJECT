<x-layouts.app>
    <x-slot:title>
        Lupa Password — JogjaTouch
    </x-slot:title>

    <main id="login-bg" class="min-h-[80vh] flex items-center justify-center py-16 relative overflow-hidden" style="background: #ffffff;">
        <!-- Soft blur overlay -->
        <div class="absolute inset-0 backdrop-blur-[2px] bg-white/5 pointer-events-none"></div>

        <!-- Interactive canvas background -->
        <canvas id="bg-canvas" class="absolute inset-0 w-full h-full" style="pointer-events:none;"></canvas>

        <div class="relative w-full max-w-md px-6" style="z-index:10;">
            <!-- Main Login Card -->
            <div class="relative bg-white rounded-[2.5rem] p-8 md:p-10 shadow-xl border border-[#1E1B19]/5">
                
                <!-- Close Button -->
                <button onclick="window.location.href='{{ route('login') }}'" class="absolute top-6 right-6 w-9 h-9 rounded-full bg-[#1E1B19]/5 flex items-center justify-center text-[#1E1B19]/70 hover:bg-[#1E1B19]/10 transition-colors" aria-label="Close">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Logo -->
                <div class="flex justify-center mb-6">
                    <div class="w-14 h-14 rounded-2xl border border-neutral-100 bg-white p-2 flex items-center justify-center shadow-sm">
                        <img src="{{ asset('assets/logo jogja touch border white.png') }}" alt="Jogja Touch Logo" class="w-10 h-10 object-contain">
                    </div>
                </div>

                <!-- FORGOT PASSWORD FORM -->
                <div>
                    <div class="text-center mb-8">
                        <h3 class="font-serif-display text-3xl font-extrabold tracking-tight text-[#1E1B19]">
                            Lupa <span class="text-[#E35D25] italic font-semibold">Password</span>
                        </h3>
                        <p class="text-sm text-[#1E1B19]/60 mt-3 leading-relaxed">
                            Masukkan email yang terdaftar. Kami akan mengirimkan kode OTP untuk mereset password Anda.
                        </p>
                    </div>

                    @if(session('status'))
                        <div class="mb-6 p-4 rounded-xl bg-[#F2FDF6] border border-emerald-500/10 text-emerald-600 text-sm font-medium text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('lupa-password.send-otp') }}">
                        @csrf
                        <!-- Email Input -->
                        <div class="mb-6">
                            <label for="email" class="block text-[11px] font-bold tracking-wider text-[#1E1B19]/50 uppercase mb-2">
                                Email
                            </label>
                            <input type="email" id="email" name="email" required placeholder="nama@email.com" value="{{ old('email') }}"
                                class="w-full px-5 py-4 rounded-2xl bg-[#FBF9F6] border border-[#1E1B19]/10 text-sm font-medium focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all placeholder:text-[#1E1B19]/30">
                            @error('email')
                                <p class="text-xs text-red-500 mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full flex items-center justify-center gap-2 py-4 px-6 rounded-full bg-[#E35D25] hover:bg-[#c74c1a] text-white text-sm font-semibold transition-all duration-300 shadow-lg shadow-[#E35D25]/15 active:scale-[0.98]">
                            <span>Kirim Kode</span>
                            <!-- Send Icon -->
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"></path>
                            </svg>
                        </button>
                    </form>

                    <!-- Kembali ke masuk link -->
                    <div class="text-center mt-6">
                        <a href="{{ route('login') }}" class="text-xs text-[#E35D25] hover:underline font-bold inline-flex items-center gap-1">
                            &larr; Kembali ke Masuk
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </main>

    @push('scripts')
    <!-- Background Canvas and Ripple Script (same as registration page) -->
    <script>
        (function () {
            const canvas = document.getElementById('bg-canvas');
            const ctx    = canvas.getContext('2d');
            const bg     = document.getElementById('login-bg');
            const mouse  = { x: -999, y: -999 };
            const ripples    = [];
            const particles  = [];
            const NUM_PARTICLES = 28;

            function resize() {
                canvas.width  = bg.offsetWidth;
                canvas.height = bg.offsetHeight;
            }
            resize();
            window.addEventListener('resize', () => { resize(); initOrbs(); });

            const orbs = [];
            function initOrbs() {
                orbs.length = 0;
                for (let i = 0; i < 5; i++) {
                    orbs.push({
                        x:     Math.random() * canvas.width,
                        y:     Math.random() * canvas.height,
                        r:     Math.random() * 180 + 160,
                        vx:    (Math.random() - 0.5) * 0.9,
                        vy:    (Math.random() - 0.5) * 0.9,
                        phase: Math.random() * Math.PI * 2,
                        speed: Math.random() * 0.35 + 0.15,
                    });
                }
            }
            initOrbs();

            bg.addEventListener('mousemove', (e) => {
                const r = bg.getBoundingClientRect();
                mouse.x = e.clientX - r.left;
                mouse.y = e.clientY - r.top;
            });

            let lastRipple = 0;
            bg.addEventListener('mousemove', (e) => {
                const now = Date.now();
                if (now - lastRipple > 600) {
                    const r = bg.getBoundingClientRect();
                    ripples.push(new Ripple(e.clientX - r.left, e.clientY - r.top));
                    lastRipple = now;
                }
            });
            bg.addEventListener('click', (e) => {
                const r = bg.getBoundingClientRect();
                ripples.push(new Ripple(e.clientX - r.left, e.clientY - r.top, 1.4));
            });

            function Ripple(x, y, scale = 1) {
                this.x = x; this.y = y;
                this.radius    = 0;
                this.maxRadius = 160 * scale;
                this.speed     = 2.5 * scale;
                this.done      = false;
                this.draw = function () {
                    const progress = this.radius / this.maxRadius;
                    ctx.save();
                    ctx.globalAlpha = 0.45 * (1 - progress);
                    ctx.strokeStyle = 'rgba(227,93,37,0.9)';
                    ctx.lineWidth   = 1.5 * (1 - progress * 0.5);
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                    ctx.stroke();
                    if (this.radius > 20) {
                        ctx.globalAlpha = 0.22 * (1 - progress);
                        ctx.beginPath();
                        ctx.arc(this.x, this.y, this.radius * 0.6, 0, Math.PI * 2);
                        ctx.stroke();
                    }
                    ctx.restore();
                };
                this.update = function () {
                    this.radius += this.speed;
                    if (this.radius >= this.maxRadius) this.done = true;
                };
            }

            const SHAPES = ['circle', 'hex', 'ring', 'plus', 'triangle', 'diamond'];
            function Particle() {
                this.reset = function () {
                    this.x    = Math.random() * canvas.width;
                    this.y    = Math.random() * canvas.height;
                    this.vx   = (Math.random() - 0.5) * 0.25;
                    this.vy   = (Math.random() - 0.5) * 0.25;
                    this.size = Math.random() * 32 + 10;
                    this.base = this.opacity = Math.random() * 0.18 + 0.06;
                    this.shape    = SHAPES[Math.floor(Math.random() * SHAPES.length)];
                    this.rotation = Math.random() * Math.PI * 2;
                    this.rotSpeed = (Math.random() - 0.5) * 0.008;
                };
                this.reset();

                this.update = function () {
                    ripples.forEach(rp => {
                        const dx = this.x - rp.x, dy = this.y - rp.y;
                        const d  = Math.hypot(dx, dy);
                        const delta = Math.abs(d - rp.radius);
                        if (delta < 40) {
                            const f = ((40 - delta) / 40) * 0.6 * (rp.radius / rp.maxRadius < 0.5 ? 1 : 0.4);
                            const a = Math.atan2(dy, dx);
                            this.vx += Math.cos(a) * f;
                            this.vy += Math.sin(a) * f;
                        }
                    });

                    const dx = this.x - mouse.x, dy = this.y - mouse.y;
                    const d  = Math.hypot(dx, dy);
                    if (d < 110 && d > 0) {
                        const f = ((110 - d) / 110) * 0.45;
                        this.vx += (dx / d) * f;
                        this.vy += (dy / d) * f;
                    }

                    this.vx *= 0.96; this.vy *= 0.96;
                    this.x  += this.vx; this.y += this.vy;
                    this.rotation += this.rotSpeed;

                    this.opacity = d < 200
                        ? this.base + (0.25 - this.base) * (1 - d / 200)
                        : this.base;

                    const pad = 60;
                    if (this.x < -pad)              this.x = canvas.width  + pad;
                    if (this.x > canvas.width  + pad) this.x = -pad;
                    if (this.y < -pad)              this.y = canvas.height + pad;
                    if (this.y > canvas.height + pad) this.y = -pad;
                };

                this.draw = function () {
                    const s = this.size;
                    ctx.save();
                    ctx.translate(this.x, this.y);
                    ctx.rotate(this.rotation);
                    ctx.globalAlpha  = this.opacity;
                    ctx.strokeStyle  = 'rgba(227,93,37,0.85)';
                    ctx.fillStyle    = 'rgba(227,93,37,0.07)';
                    ctx.lineWidth    = 1.4;

                    ctx.beginPath();
                    switch (this.shape) {
                        case 'circle':
                            ctx.arc(0, 0, s / 2, 0, Math.PI * 2);
                            ctx.fill(); ctx.stroke();
                            break;
                        case 'ring':
                            ctx.arc(0, 0, s / 2, 0, Math.PI * 2); ctx.stroke();
                            ctx.beginPath();
                            ctx.arc(0, 0, s / 5, 0, Math.PI * 2); ctx.stroke();
                            break;
                        case 'hex':
                            for (let i = 0; i < 6; i++) {
                                const a = (i / 6) * Math.PI * 2 - Math.PI / 6;
                                i === 0 ? ctx.moveTo(Math.cos(a) * s/2, Math.sin(a) * s/2)
                                        : ctx.lineTo(Math.cos(a) * s/2, Math.sin(a) * s/2);
                            }
                            ctx.closePath(); ctx.fill(); ctx.stroke();
                            break;
                        case 'plus': {
                            const t = s / 3;
                            ctx.rect(-t/2, -s/2, t, s);
                            ctx.rect(-s/2, -t/2, s, t);
                            ctx.fill();
                            break;
                        }
                        case 'triangle':
                            ctx.moveTo(0, -s/2);
                            ctx.lineTo(s/2, s/2);
                            ctx.lineTo(-s/2, s/2);
                            ctx.closePath(); ctx.fill(); ctx.stroke();
                            break;
                        case 'diamond':
                            ctx.moveTo(0, -s/2);
                            ctx.lineTo(s/2, 0);
                            ctx.lineTo(0,  s/2);
                            ctx.lineTo(-s/2, 0);
                            ctx.closePath(); ctx.fill(); ctx.stroke();
                            break;
                    }
                    ctx.restore();
                };
            }

            for (let i = 0; i < NUM_PARTICLES; i++) particles.push(new Particle());

            function loop() {
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                const t = Date.now() * 0.001;
                orbs.forEach(o => {
                    o.x += o.vx; o.y += o.vy;
                    if (o.x < -o.r) o.x = canvas.width  + o.r;
                    if (o.x > canvas.width  + o.r) o.x = -o.r;
                    if (o.y < -o.r) o.y = canvas.height + o.r;
                    if (o.y > canvas.height + o.r) o.y = -o.r;

                    const pulse = 0.5 + 0.5 * Math.sin(t * o.speed + o.phase);
                    const alpha = (0.03 + pulse * 0.17).toFixed(2);

                    const g = ctx.createRadialGradient(o.x, o.y, 0, o.x, o.y, o.r);
                    g.addColorStop(0,    `rgba(255,153,80,${alpha})`);
                    g.addColorStop(0.5,  `rgba(255,185,130,${(parseFloat(alpha) * 0.45).toFixed(2)})`);
                    g.addColorStop(1,    'rgba(255,255,255,0)');
                    ctx.fillStyle = g;
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                });

                for (let i = ripples.length - 1; i >= 0; i--) {
                    ripples[i].update();
                    ripples[i].draw();
                    if (ripples[i].done) ripples.splice(i, 1);
                }

                particles.forEach(p => { p.update(); p.draw(); });

                requestAnimationFrame(loop);
            }
            loop();
        })();
    </script>
    @endpush
</x-layouts.app>
