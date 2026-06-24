<x-layouts.app>
    <x-slot:title>
        Verifikasi OTP — JogjaTouch
    </x-slot:title>

    <main id="otp-bg" class="min-h-[80vh] flex items-center justify-center py-16 relative overflow-hidden" style="background: #ffffff;">
        <!-- Soft blur overlay -->
        <div class="absolute inset-0 backdrop-blur-[2px] bg-white/5 pointer-events-none"></div>

        <div class="relative w-full max-w-md px-6" style="z-index:10;">
            <!-- Main Card -->
            <div class="relative bg-white rounded-[2.5rem] p-8 md:p-10 shadow-xl border border-[#1E1B19]/5">
                
                <!-- Close Button -->
                <button onclick="window.location.href='{{ route('daftar') }}'" class="absolute top-6 right-6 w-9 h-9 rounded-full bg-[#1E1B19]/5 flex items-center justify-center text-[#1E1B19]/70 hover:bg-[#1E1B19]/10 transition-colors" aria-label="Close">
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

                <div id="step-otp-verification">
                    <div class="text-center mb-6">
                        <h3 class="font-serif-display text-3xl font-extrabold tracking-tight text-[#1E1B19]">
                            Masukkan <span class="text-[#E35D25] italic font-semibold">kode OTP</span>
                        </h3>
                        <p class="text-sm text-[#1E1B19]/60 mt-3 leading-relaxed">
                            6 digit kode telah dikirim ke Email Anda.
                        </p>
                    </div>

                    @if(session('error'))
                        <div class="mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-red-600 text-xs font-medium text-center">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="mb-4 p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-600 text-xs font-medium text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Back Button -->
                    <a href="{{ route('daftar') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#1E1B19]/60 hover:text-[#E35D25] mb-4 transition-colors">
                        &larr; Ganti email / daftar ulang
                    </a>

                    <!-- Notification Card -->
                    <div class="flex items-start gap-4 p-4 bg-[#F2FDF6] rounded-2xl border border-emerald-500/10 mb-6">
                        <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white shrink-0 shadow-md shadow-emerald-500/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[#1E1B19]">Cek Email Anda</h4>
                            <p class="text-xs text-[#1E1B19]/60 mt-0.5 font-medium leading-relaxed">
                                Kode dikirim ke <span class="font-bold text-[#1E1B19]/80">{{ $email }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Verification Form -->
                    <form method="POST" action="{{ route('register.verify-otp') }}">
                        @csrf
                        <!-- 6 Digit Code Input -->
                        <div class="mb-6">
                            <label class="block text-[11px] font-bold tracking-wider text-[#1E1B19]/50 uppercase mb-3">
                                Kode 6 Digit
                            </label>
                            <input type="text" name="otp" maxlength="6" pattern="[0-9]*" inputmode="numeric" 
                                class="w-full text-center tracking-[1em] text-2xl font-bold px-5 py-4 rounded-xl bg-[#FBF9F6] border border-[#1E1B19]/10 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all placeholder:text-[#1E1B19]/20" 
                                placeholder="••••••" required>
                            @error('otp')<p class="text-xs text-red-500 mt-2 font-medium">{{ $message }}</p>@enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full flex items-center justify-center gap-2 py-4 px-6 rounded-full bg-[#E35D25] hover:bg-[#c74c1a] text-white text-sm font-semibold transition-all duration-300 shadow-lg shadow-[#E35D25]/15 active:scale-[0.98]">
                            <span>Verifikasi & Masuk</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </main>
</x-layouts.app>
