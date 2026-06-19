<x-layouts.app>
    <x-slot:title>
        Buat Akun Pelanggan — JogjaTouch
    </x-slot:title>

    <main id="daftar-bg" class="min-h-[80vh] flex items-center justify-center py-16 relative overflow-hidden" style="background: #ffffff;">
        <!-- Soft blur overlay -->
        <div class="absolute inset-0 backdrop-blur-[2px] bg-white/5 pointer-events-none"></div>

        <!-- Interactive canvas background -->
        <canvas id="bg-canvas" class="absolute inset-0 w-full h-full" style="pointer-events:none;"></canvas>

        <div class="relative w-full max-w-md px-6" style="z-index:10;">
            <!-- Main Registration Card -->
            <div class="relative bg-white rounded-[2.5rem] p-8 md:p-10 shadow-xl border border-[#1E1B19]/5">
                
                <!-- Close Button -->
                <button onclick="window.location.href='/'" class="absolute top-6 right-6 w-9 h-9 rounded-full bg-[#1E1B19]/5 flex items-center justify-center text-[#1E1B19]/70 hover:bg-[#1E1B19]/10 transition-colors" aria-label="Close">
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

                <!-- STEP 1: FILL REGISTRATION DETAILS -->
                <div id="step-registration-form">
                    <div class="text-center mb-8">
                        <h3 class="font-serif-display text-3xl font-extrabold tracking-tight text-[#1E1B19]">
                            Buat <span class="text-[#E35D25] italic font-semibold">akun baru</span>
                        </h3>
                        <p class="text-sm text-[#1E1B19]/60 mt-3 leading-relaxed">
                            Daftar untuk memantau pesanan dan riwayat layanan Anda.
                        </p>
                    </div>

                    <form id="register-form" onsubmit="submitRegistration(event)">
                        @csrf
                        <!-- Nama Input -->
                        <div class="mb-4">
                            <label for="reg-name" class="block text-[11px] font-bold tracking-wider text-[#1E1B19]/50 uppercase mb-2">
                                Nama Lengkap
                            </label>
                            <input type="text" id="reg-name" required placeholder="Nama lengkap Anda" 
                                class="w-full px-5 py-4 rounded-2xl bg-[#FBF9F6] border border-[#1E1B19]/10 text-sm font-medium focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all placeholder:text-[#1E1B19]/30">
                        </div>

                        <!-- Email Input -->
                        <div class="mb-4">
                            <label for="reg-email" class="block text-[11px] font-bold tracking-wider text-[#1E1B19]/50 uppercase mb-2">
                                Email
                            </label>
                            <input type="email" id="reg-email" required placeholder="nama@email.com" 
                                class="w-full px-5 py-4 rounded-2xl bg-[#FBF9F6] border border-[#1E1B19]/10 text-sm font-medium focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all placeholder:text-[#1E1B19]/30">
                        </div>

                        <!-- Telepon Input -->
                        <div class="mb-4">
                            <label for="reg-whatsapp" class="block text-[11px] font-bold tracking-wider text-[#1E1B19]/50 uppercase mb-2">
                                No. Telepon
                            </label>
                            <input type="text" id="reg-whatsapp" required placeholder="+62 8xx" 
                                class="w-full px-5 py-4 rounded-2xl bg-[#FBF9F6] border border-[#1E1B19]/10 text-sm font-medium focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all placeholder:text-[#1E1B19]/30">
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <label for="reg-password" class="block text-[11px] font-bold tracking-wider text-[#1E1B19]/50 uppercase mb-2">
                                Password
                            </label>
                            <input type="password" id="reg-password" required placeholder="Minimal 6 karakter" 
                                class="w-full px-5 py-4 rounded-2xl bg-[#FBF9F6] border border-[#1E1B19]/10 text-sm font-medium focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all placeholder:text-[#1E1B19]/30">
                        </div>

                        <!-- Konfirmasi Password Input -->
                        <div class="mb-6">
                            <label for="reg-password-confirm" class="block text-[11px] font-bold tracking-wider text-[#1E1B19]/50 uppercase mb-2">
                                Konfirmasi Password
                            </label>
                            <input type="password" id="reg-password-confirm" required placeholder="Ulangi password" 
                                class="w-full px-5 py-4 rounded-2xl bg-[#FBF9F6] border border-[#1E1B19]/10 text-sm font-medium focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all placeholder:text-[#1E1B19]/30">
                            <p id="reg-error" class="hidden text-xs text-red-500 mt-2 font-medium"></p>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full flex items-center justify-center gap-2 py-4 px-6 rounded-full bg-[#E35D25] hover:bg-[#c74c1a] text-white text-sm font-semibold transition-all duration-300 shadow-lg shadow-[#E35D25]/15 active:scale-[0.98]">
                            <span>Daftar & Masuk</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                    </form>

                    <!-- Sudah punya akun link -->
                    <div class="text-center mt-6">
                        <span class="text-xs text-[#1E1B19]/60 font-medium">Sudah punya akun? </span>
                        <a href="{{ route('login') }}" class="text-xs text-[#E35D25] hover:underline font-bold inline-flex items-center gap-1">
                            Masuk di sini &rarr;
                        </a>
                    </div>
                </div>

                <!-- STEP 2: VERIFICATION OTP -->
                <div id="step-otp-verification" class="hidden">
                    <div class="text-center mb-6">
                        <h3 class="font-serif-display text-3xl font-extrabold tracking-tight text-[#1E1B19]">
                            Masukkan <span class="text-[#E35D25] italic font-semibold">kode OTP</span>
                        </h3>
                        <p class="text-sm text-[#1E1B19]/60 mt-3 leading-relaxed">
                            6 digit kode telah dikirim ke WhatsApp Anda.
                        </p>
                    </div>

                    <!-- Back Button -->
                    <button onclick="backToRegistrationStep()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#1E1B19]/60 hover:text-[#E35D25] mb-4 transition-colors">
                        &larr; Ganti nomor / nama
                    </button>

                    <!-- WhatsApp Notification Card -->
                    <div class="flex items-start gap-4 p-4 bg-[#F2FDF6] rounded-2xl border border-emerald-500/10 mb-6">
                        <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white shrink-0 shadow-md shadow-emerald-500/20">
                            <!-- WA SVG Icon -->
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.963C16.588 1.981 14.117.957 11.5.957c-5.442 0-9.87 4.372-9.874 9.802-.001 1.774.469 3.506 1.362 5.048L1.933 21.9l6.3-1.656c1.602.875 3.323 1.336 5.08 1.336z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[#1E1B19]">Cek WhatsApp Anda</h4>
                            <p class="text-xs text-[#1E1B19]/60 mt-0.5 font-medium leading-relaxed">
                                Kode dikirim ke <span id="display-wa-number" class="font-bold text-[#1E1B19]/80">+62 856-7890-544332</span>
                            </p>
                        </div>
                    </div>

                    <!-- Verification Form -->
                    <form id="otp-form" onsubmit="submitOtp(event)">
                        @csrf
                        <!-- 6 Digit Code Input -->
                        <div class="mb-6">
                            <label class="block text-[11px] font-bold tracking-wider text-[#1E1B19]/50 uppercase mb-3">
                                Kode 6 Digit
                            </label>
                            <div class="flex justify-between gap-2.5" id="otp-inputs-container">
                                @for ($i = 0; $i < 6; $i++)
                                    <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" 
                                        class="otp-digit-input w-12 h-14 text-center text-xl font-bold rounded-xl bg-[#FBF9F6] border border-[#1E1B19]/10 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all placeholder:text-[#1E1B19]/20" 
                                        placeholder="•" required>
                                @endfor
                            </div>
                            <p id="otp-error" class="hidden text-xs text-red-500 mt-2 font-medium"></p>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full flex items-center justify-center gap-2 py-4 px-6 rounded-full bg-[#E35D25] hover:bg-[#c74c1a] text-white text-sm font-semibold transition-all duration-300 shadow-lg shadow-[#E35D25]/15 active:scale-[0.98]">
                            <span>Verifikasi & Masuk</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                    </form>

                    <!-- OTP Footer Meta Info -->
                    <div class="text-center mt-6 space-y-2">
                        <p class="text-xs text-[#1E1B19]/60 font-medium">
                            Belum dapat kode? Kirim ulang dalam <span id="timer-countdown" class="font-bold text-[#1E1B19]">21s</span>
                        </p>
                        <p class="text-[11px] text-[#1E1B19]/40 bg-[#FBF9F6] py-2 px-3 rounded-lg border border-[#1E1B19]/5 font-medium">
                            Demo: gunakan kode <span id="demo-otp-code" class="font-bold text-[#E35D25]">123456</span> untuk login.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </main>

    @push('scripts')
    <script>
        // ── Interactive background: floating silhouettes + water ripple ──
        (function () {
            const canvas = document.getElementById('bg-canvas');
            const ctx    = canvas.getContext('2d');
            const bg     = document.getElementById('daftar-bg');
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

            // ── Moving radial orbs ──
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

            // Track mouse on the main background element
            bg.addEventListener('mousemove', (e) => {
                const r = bg.getBoundingClientRect();
                mouse.x = e.clientX - r.left;
                mouse.y = e.clientY - r.top;
            });

            // Create ripple on click or every 600ms of movement
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

            // ── Ripple ──
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
                    // second inner ring
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

            // ── Particle (floating silhouette) ──
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
                    // ripple push
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

                    // mouse soft repulsion
                    const dx = this.x - mouse.x, dy = this.y - mouse.y;
                    const d  = Math.hypot(dx, dy);
                    if (d < 110 && d > 0) {
                        const f = ((110 - d) / 110) * 0.45;
                        this.vx += (dx / d) * f;
                        this.vy += (dy / d) * f;
                    }

                    // dampen + drift
                    this.vx *= 0.96; this.vy *= 0.96;
                    this.x  += this.vx; this.y += this.vy;
                    this.rotation += this.rotSpeed;

                    // opacity pulse near mouse
                    this.opacity = d < 200
                        ? this.base + (0.25 - this.base) * (1 - d / 200)
                        : this.base;

                    // wrap edges
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

            // ── Animation loop ──
            function loop() {
                // White base
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                // Moving radial orbs
                const t = Date.now() * 0.001;
                orbs.forEach(o => {
                    o.x += o.vx; o.y += o.vy;
                    if (o.x < -o.r) o.x = canvas.width  + o.r;
                    if (o.x > canvas.width  + o.r) o.x = -o.r;
                    if (o.y < -o.r) o.y = canvas.height + o.r;
                    if (o.y > canvas.height + o.r) o.y = -o.r;

                    const pulse = 0.5 + 0.5 * Math.sin(t * o.speed + o.phase);
                    const alpha = (0.03 + pulse * 0.17).toFixed(2); // 0.03 → 0.20

                    const g = ctx.createRadialGradient(o.x, o.y, 0, o.x, o.y, o.r);
                    g.addColorStop(0,    `rgba(255,153,80,${alpha})`);
                    g.addColorStop(0.5,  `rgba(255,185,130,${(parseFloat(alpha) * 0.45).toFixed(2)})`);
                    g.addColorStop(1,    'rgba(255,255,255,0)');
                    ctx.fillStyle = g;
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                });

                // update & draw ripples
                for (let i = ripples.length - 1; i >= 0; i--) {
                    ripples[i].update();
                    ripples[i].draw();
                    if (ripples[i].done) ripples.splice(i, 1);
                }

                // update & draw particles
                particles.forEach(p => { p.update(); p.draw(); });

                requestAnimationFrame(loop);
            }
            loop();
        })();
    </script>
    <script>
        let resendCountdown = 21;
        let countdownInterval = null;
        let tempUser = {};

        function submitRegistration(e) {
            e.preventDefault();
            const name = document.getElementById('reg-name').value.trim();
            const email = document.getElementById('reg-email').value.trim();
            const whatsapp = document.getElementById('reg-whatsapp').value.trim();
            const password = document.getElementById('reg-password').value;
            const passwordConfirm = document.getElementById('reg-password-confirm').value;
            const errorElement = document.getElementById('reg-error');

            if (!name || !email || !whatsapp || !password || !passwordConfirm) {
                errorElement.textContent = 'Semua field wajib diisi.';
                errorElement.classList.remove('hidden');
                return;
            }

            if (password.length < 6) {
                errorElement.textContent = 'Password minimal harus 6 karakter.';
                errorElement.classList.remove('hidden');
                return;
            }

            if (password !== passwordConfirm) {
                errorElement.textContent = 'Konfirmasi password tidak cocok.';
                errorElement.classList.remove('hidden');
                return;
            }

            errorElement.classList.add('hidden');
            tempUser = { 
                name, 
                email, 
                whatsapp, 
                password, 
                password_confirmation: passwordConfirm 
            };

            // Call backend to store registration details temporarily in session
            fetch('{{ route("register.send-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(tempUser)
            })
            .then(async res => {
                const data = await res.json();
                if (res.ok && data.success) {
                    document.getElementById('display-wa-number').textContent = data.whatsapp;
                    // Show demo OTP code when backend returns it (for local/demo use)
                    if (data.otp) {
                        const demoEl = document.getElementById('demo-otp-code');
                        if (demoEl) demoEl.textContent = data.otp;
                    }
                    
                    // Transition to OTP verification step
                    document.getElementById('step-registration-form').classList.add('hidden');
                    document.getElementById('step-otp-verification').classList.remove('hidden');
                    
                    startCountdown();
                    
                    // Auto focus first OTP digit input
                    setTimeout(() => {
                        const firstInput = document.querySelector('.otp-digit-input');
                        if (firstInput) firstInput.focus();
                    }, 50);
                } else {
                    let errorMsg = data.message || 'Terjadi kesalahan saat mengirim OTP.';
                    if (data.errors) {
                        errorMsg = Object.values(data.errors).flat().join(' ');
                    }
                    errorElement.textContent = errorMsg;
                    errorElement.classList.remove('hidden');
                }
            })
            .catch(err => {
                errorElement.textContent = 'Koneksi gagal. Coba lagi.';
                errorElement.classList.remove('hidden');
            });
        }

        function submitOtp(e) {
            e.preventDefault();
            const errorElement = document.getElementById('otp-error');
            
            // Gather OTP digits
            let otpValue = '';
            document.querySelectorAll('.otp-digit-input').forEach(input => {
                otpValue += input.value;
            });

            if (otpValue.length !== 6) {
                errorElement.textContent = 'Masukkan 6 digit kode lengkap.';
                errorElement.classList.remove('hidden');
                return;
            }

            errorElement.classList.add('hidden');

            fetch('{{ route("register.verify-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ otp: otpValue })
            })
            .then(async res => {
                const data = await res.json();
                if (res.ok && data.success) {
                    // Redirect to Customer Account page
                    window.location.href = '{{ route("akun") }}';
                } else {
                    errorElement.textContent = data.message || 'Kode OTP salah. Gunakan kode 123456.';
                    errorElement.classList.remove('hidden');
                }
            })
            .catch(err => {
                errorElement.textContent = 'Verifikasi gagal. Coba lagi.';
                errorElement.classList.remove('hidden');
            });
        }

        function backToRegistrationStep() {
            document.getElementById('step-otp-verification').classList.add('hidden');
            document.getElementById('step-registration-form').classList.remove('hidden');
            clearInterval(countdownInterval);
        }

        function startCountdown() {
            resendCountdown = 21;
            const display = document.getElementById('timer-countdown');
            display.textContent = `${resendCountdown}s`;
            
            clearInterval(countdownInterval);
            countdownInterval = setInterval(() => {
                resendCountdown--;
                if (resendCountdown <= 0) {
                    clearInterval(countdownInterval);
                    display.innerHTML = '<button type="button" onclick="resendOtp()" class="text-[#E35D25] hover:underline font-bold">Kirim ulang</button>';
                } else {
                    display.textContent = `${resendCountdown}s`;
                }
            }, 1000);
        }

        function resendOtp() {
            fetch('{{ route("register.send-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(tempUser)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    startCountdown();
                }
            });
        }

        // Set up OTP inputs auto-tabbing
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('.otp-digit-input');
            
            inputs.forEach((input, index) => {
                input.addEventListener('input', (e) => {
                    const value = e.target.value;
                    if (value && !/^\d$/.test(value)) {
                        e.target.value = '';
                        return;
                    }
                    
                    if (value && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });

                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && !e.target.value && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
            });
        });
    </script>
    @endpush
</x-layouts.app>
