<x-layouts.app>
    <x-slot:title>
        Buat Password Baru — JogjaTouch
    </x-slot:title>

    <main id="auth-bg" class="min-h-[80vh] flex items-center justify-center py-16 relative overflow-hidden" style="background: #ffffff;">
        <!-- Soft blur overlay -->
        <div class="absolute inset-0 backdrop-blur-[2px] bg-white/5 pointer-events-none"></div>

        <div class="relative w-full max-w-md px-6" style="z-index:10;">
            <!-- Main Card -->
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

                <!-- Form Section -->
                <div id="step-new-password">
                    <div class="text-center mb-8">
                        <h3 class="font-serif-display text-3xl font-extrabold tracking-tight text-[#1E1B19]">
                            Buat <span class="text-[#E35D25] italic font-semibold">Password Baru</span>
                        </h3>
                        <p class="text-sm text-[#1E1B19]/60 mt-3 leading-relaxed">
                            Silakan masukkan password baru untuk akun Anda.
                        </p>
                    </div>

                    @if(session('error'))
                        <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-600 text-sm font-medium flex gap-3 items-center">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('lupa-password.reset') }}" class="space-y-5">
                        @csrf
                        
                        <!-- Password Input -->
                        <div>
                            <label class="block text-xs font-bold tracking-wide text-[#1E1B19]/70 mb-2 ml-1">Password Baru</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-[#1E1B19]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input type="password" name="password" 
                                    class="w-full pl-11 pr-4 py-3.5 rounded-xl bg-[#FBF9F6] border border-[#1E1B19]/10 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all placeholder:text-[#1E1B19]/30 text-sm font-medium text-[#1E1B19]" 
                                    placeholder="Minimal 8 karakter" required>
                            </div>
                            @error('password')<p class="text-xs text-red-500 mt-1.5 ml-1 font-medium">{{ $message }}</p>@enderror
                        </div>

                        <!-- Confirm Password Input -->
                        <div>
                            <label class="block text-xs font-bold tracking-wide text-[#1E1B19]/70 mb-2 ml-1">Konfirmasi Password Baru</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-[#1E1B19]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <input type="password" name="password_confirmation" 
                                    class="w-full pl-11 pr-4 py-3.5 rounded-xl bg-[#FBF9F6] border border-[#1E1B19]/10 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all placeholder:text-[#1E1B19]/30 text-sm font-medium text-[#1E1B19]" 
                                    placeholder="Ulangi password baru" required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full flex items-center justify-center gap-2 py-3.5 px-6 rounded-xl bg-[#E35D25] hover:bg-[#c74c1a] text-white text-sm font-semibold transition-all duration-300 shadow-lg shadow-[#E35D25]/15 active:scale-[0.98] mt-2">
                            <span>Simpan Password</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-layouts.app>
