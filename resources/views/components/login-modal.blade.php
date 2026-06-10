<!-- Login & Verification Modal Container -->
<div id="auth-modal" class="fixed inset-0 z-100 hidden items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-all duration-300">
    
    <!-- MODAL CARD 1: PHONE NUMBER INPUT -->
    <div id="modal-step-phone" class="relative w-full max-w-md bg-white rounded-[2rem] p-8 md:p-10 shadow-2xl transition-all scale-95 opacity-0 duration-300 transform">
        <!-- Close Button -->
        <button onclick="closeAuthModal()" class="absolute top-6 right-6 w-9 h-9 rounded-full bg-[#1E1B19]/5 flex items-center justify-center text-[#1E1B19]/70 hover:bg-[#1E1B19]/10 transition-colors" aria-label="Close">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <div class="w-14 h-14 rounded-xl border border-neutral-100 bg-[#FFFFFF] p-2 flex items-center justify-center shadow-sm">
                <img src="{{ asset('assets/logo jogja touch border white.png') }}" alt="Jogja Touch Logo" class="w-10 h-10 object-contain">
            </div>
        </div>

        <!-- Header -->
        <div class="text-center mb-8">
            <h3 class="font-serif-display text-3xl font-extrabold tracking-tight text-[#1E1B19]">
                Masuk ke <span class="text-[#E35D25] italic font-semibold">JogjaTouch</span>
            </h3>
            <p class="text-sm text-[#1E1B19]/60 mt-3 leading-relaxed">
                Pantau pesanan Anda, lihat riwayat, dan akses dashboard pelanggan.
            </p>
        </div>

        <!-- Form -->
        <form id="phone-form" onsubmit="handleSendOtp(event)">
            @csrf
            <!-- Whatsapp Input -->
            <div class="mb-6">
                <label for="whatsapp-input" class="block text-[11px] font-bold tracking-wider text-[#1E1B19]/50 uppercase mb-2">
                    No. WhatsApp
                </label>
                <div class="relative">
                    <input type="text" id="whatsapp-input" required placeholder="08xx atau +62 8xx" 
                        class="w-full px-5 py-4 rounded-2xl bg-[#FBF9F6] border border-[#1E1B19]/10 text-sm font-medium focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all placeholder:text-[#1E1B19]/30">
                </div>
                <p id="phone-error" class="hidden text-xs text-red-500 mt-2 font-medium"></p>
            </div>

            <!-- Submit OTP Button -->
            <button type="submit" id="btn-send-otp" class="w-full flex items-center justify-center gap-2 py-4 px-6 rounded-full bg-[#E35D25] hover:bg-[#c74c1a] text-white text-sm font-semibold transition-all duration-300 shadow-lg shadow-[#E35D25]/15 active:scale-[0.98]">
                <!-- Phone Icon -->
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.62 10.79a15.15 15.15 0 006.59 6.59l2.2-2.2a1 1 0 011.11-.27 11.72 11.72 0 003.7 1.09 1 1 0 01.95 1v3.58a1 1 0 01-1 1A16 16 0 013 3a1 1 0 011-1h3.58a1 1 0 011 .95 11.72 11.72 0 001.09 3.7 1 1 0 01-.27 1.11l-2.2 2.2z"/>
                </svg>
                <span>Kirim Kode OTP via WhatsApp</span>
            </button>
        </form>

        <!-- Divider -->
        <div class="flex items-center my-6">
            <div class="flex-grow border-t border-[#1E1B19]/10"></div>
            <span class="mx-4 text-[10px] font-bold tracking-wider text-[#1E1B19]/40 uppercase">Atau</span>
            <div class="flex-grow border-t border-[#1E1B19]/10"></div>
        </div>

        <!-- Google Login -->
        <button onclick="handleGoogleLogin()" class="w-full flex items-center justify-center gap-3 py-3.5 px-6 rounded-full border border-[#1E1B19]/15 bg-white hover:bg-[#FBF9F6] text-sm font-semibold text-[#1E1B19] transition-all duration-300 active:scale-[0.98]">
            <!-- Google Logo -->
            <svg class="w-4 h-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
            </svg>
            <span>Masuk dengan Google</span>
        </button>

        <!-- Footer Link -->
        <div class="text-center mt-8">
            <a href="#tracking" onclick="closeAuthModal()" class="inline-flex items-center gap-1 text-xs font-semibold text-[#E35D25] hover:underline">
                Belum tahu pesanan Anda? Cek status tanpa login &rarr;
            </a>
        </div>
    </div>

    <!-- MODAL CARD 2: VERIFICATION OTP -->
    <div id="modal-step-otp" class="relative w-full max-w-md bg-white rounded-[2rem] p-8 md:p-10 shadow-2xl transition-all scale-95 opacity-0 duration-300 transform hidden">
        <!-- Close Button -->
        <button onclick="closeAuthModal()" class="absolute top-6 right-6 w-9 h-9 rounded-full bg-[#1E1B19]/5 flex items-center justify-center text-[#1E1B19]/70 hover:bg-[#1E1B19]/10 transition-colors" aria-label="Close">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <div class="w-14 h-14 rounded-xl border border-neutral-100 bg-[#FFFFFF] p-2 flex items-center justify-center shadow-sm">
                <img src="{{ asset('assets/logo jogja touch border white.png') }}" alt="Jogja Touch Logo" class="w-10 h-10 object-contain">
            </div>
        </div>

        <!-- Header -->
        <div class="text-center mb-6">
            <h3 class="font-serif-display text-3xl font-extrabold tracking-tight text-[#1E1B19]">
                Masukkan <span class="text-[#E35D25] italic font-semibold">kode OTP</span>
            </h3>
            <p class="text-sm text-[#1E1B19]/60 mt-3 leading-relaxed">
                6 digit kode telah dikirim ke WhatsApp Anda.
            </p>
        </div>

        <!-- Back Button -->
        <button onclick="backToPhoneStep()" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#1E1B19]/60 hover:text-[#E35D25] mb-4 transition-colors">
            &larr; Ganti nomor
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
                    Kode dikirim ke <span id="display-phone-number" class="font-bold text-[#1E1B19]/80">+62 856-7890-544332</span>
                </p>
            </div>
        </div>

        <!-- Verification Form -->
        <form id="otp-form" onsubmit="handleVerifyOtp(event)">
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
                <input type="hidden" id="full-otp-input" name="otp">
                <p id="otp-error" class="hidden text-xs text-red-500 mt-2 font-medium"></p>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="btn-verify-otp" class="w-full flex items-center justify-center gap-2 py-4 px-6 rounded-full bg-[#E35D25] hover:bg-[#c74c1a] text-white text-sm font-semibold transition-all duration-300 shadow-lg shadow-[#E35D25]/15 active:scale-[0.98]">
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
                Demo: gunakan kode <span class="font-bold text-[#E35D25]">123456</span> untuk login.
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let resendCountdown = 21;
    let countdownInterval = null;

    function openAuthModal() {
        const modal = document.getElementById('auth-modal');
        const stepPhone = document.getElementById('modal-step-phone');
        const stepOtp = document.getElementById('modal-step-otp');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Trigger reflow for animations
        setTimeout(() => {
            modal.classList.remove('bg-black/0');
            modal.classList.add('bg-black/60');
            stepPhone.classList.remove('scale-95', 'opacity-0');
            stepPhone.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeAuthModal() {
        const modal = document.getElementById('auth-modal');
        const stepPhone = document.getElementById('modal-step-phone');
        const stepOtp = document.getElementById('modal-step-otp');
        
        stepPhone.classList.add('scale-95', 'opacity-0');
        stepPhone.classList.remove('scale-100', 'opacity-100');
        stepOtp.classList.add('scale-95', 'opacity-0');
        stepOtp.classList.remove('scale-100', 'opacity-100');
        modal.classList.remove('bg-black/60');
        modal.classList.add('bg-black/0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            // Reset to step 1
            stepPhone.classList.remove('hidden');
            stepOtp.classList.add('hidden');
            document.getElementById('phone-form').reset();
            document.getElementById('otp-form').reset();
            document.getElementById('phone-error').classList.add('hidden');
            document.getElementById('otp-error').classList.add('hidden');
            clearInterval(countdownInterval);
        }, 300);
    }

    function backToPhoneStep() {
        const stepPhone = document.getElementById('modal-step-phone');
        const stepOtp = document.getElementById('modal-step-otp');
        
        stepOtp.classList.add('scale-95', 'opacity-0');
        stepOtp.classList.remove('scale-100', 'opacity-100');
        
        setTimeout(() => {
            stepOtp.classList.add('hidden');
            stepPhone.classList.remove('hidden');
            setTimeout(() => {
                stepPhone.classList.remove('scale-95', 'opacity-0');
                stepPhone.classList.add('scale-100', 'opacity-100');
            }, 10);
        }, 300);
        
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
                display.innerHTML = '<button type="button" onclick="resendOtpCode()" class="text-[#E35D25] hover:underline font-bold">Kirim ulang</button>';
            } else {
                display.textContent = `${resendCountdown}s`;
            }
        }, 1000);
    }

    function resendOtpCode() {
        const phone = document.getElementById('whatsapp-input').value;
        // Simple re-trigger send otp
        fetch('{{ route("login.send-otp") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ whatsapp: phone })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                startCountdown();
            }
        });
    }

    function handleSendOtp(e) {
        e.preventDefault();
        const phoneInput = document.getElementById('whatsapp-input');
        const phoneError = document.getElementById('phone-error');
        const phone = phoneInput.value.trim();
        
        if (!phone) {
            phoneError.textContent = 'Nomor WhatsApp wajib diisi.';
            phoneError.classList.remove('hidden');
            return;
        }

        phoneError.classList.add('hidden');
        
        fetch('{{ route("login.send-otp") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ whatsapp: phone })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('display-phone-number').textContent = data.whatsapp;
                
                // Transition to OTP step
                const stepPhone = document.getElementById('modal-step-phone');
                const stepOtp = document.getElementById('modal-step-otp');
                
                stepPhone.classList.add('scale-95', 'opacity-0');
                stepPhone.classList.remove('scale-100', 'opacity-100');
                
                setTimeout(() => {
                    stepPhone.classList.add('hidden');
                    stepOtp.classList.remove('hidden');
                    setTimeout(() => {
                        stepOtp.classList.remove('scale-95', 'opacity-0');
                        stepOtp.classList.add('scale-100', 'opacity-100');
                        // Auto focus first OTP digit input
                        document.querySelector('.otp-digit-input').focus();
                    }, 10);
                }, 300);
                
                startCountdown();
            } else {
                phoneError.textContent = 'Terjadi kesalahan. Coba lagi.';
                phoneError.classList.remove('hidden');
            }
        })
        .catch(err => {
            phoneError.textContent = 'Koneksi gagal. Coba lagi.';
            phoneError.classList.remove('hidden');
        });
    }

    function handleVerifyOtp(e) {
        e.preventDefault();
        const otpError = document.getElementById('otp-error');
        
        // Collect digits
        let otpValue = '';
        document.querySelectorAll('.otp-digit-input').forEach(input => {
            otpValue += input.value;
        });

        if (otpValue.length !== 6) {
            otpError.textContent = 'Masukkan 6 digit kode lengkap.';
            otpError.classList.remove('hidden');
            return;
        }

        otpError.classList.add('hidden');
        
        fetch('{{ route("login.verify-otp") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ otp: otpValue })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Redirect to Akun dashboard page
                window.location.href = '{{ route("akun") }}';
            } else {
                otpError.textContent = data.message || 'Kode OTP salah. Gunakan kode 123456.';
                otpError.classList.remove('hidden');
            }
        })
        .catch(err => {
            otpError.textContent = 'Verifikasi gagal. Coba lagi.';
            otpError.classList.remove('hidden');
        });
    }

    function handleGoogleLogin() {
        // Simulation for Google Login
        fetch('{{ route("login.send-otp") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ whatsapp: '+62 856-7890-544332' })
        })
        .then(res => res.json())
        .then(() => {
            fetch('{{ route("login.verify-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ otp: '123456' })
            }).then(() => {
                window.location.href = '{{ route("akun") }}';
            });
        });
    }

    // Set up auto-focus flow for OTP input digits
    document.addEventListener('DOMContentLoaded', () => {
        const inputs = document.querySelectorAll('.otp-digit-input');
        
        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                const value = e.target.value;
                // Only allow numbers
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
