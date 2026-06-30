<div class="w-full md:w-80 shrink-0">
    <div class="bg-white rounded-3xl border border-[#1E1B19]/5 p-6 shadow-sm sticky top-24">
        
        <!-- Profile Card -->
        <div class="flex flex-col items-center text-center pb-6 border-b border-[#1E1B19]/5">
            <!-- Large Avatar -->
            <div class="w-20 h-20 rounded-full bg-[#E35D25] text-white flex items-center justify-center text-3xl font-extrabold shadow-lg shadow-[#E35D25]/20 mb-4 select-none">
                {{ substr(session('user.name', 'V'), 0, 1) }}
            </div>
            
            <!-- User Info -->
            <h4 class="font-serif-display text-xl font-bold text-[#1E1B19]">
                {{ session('user.name', 'Vegli Raif') }}
            </h4>
            <p class="text-xs font-semibold text-[#1E1B19]/50 mt-1">
                {{ session('user.whatsapp', '+62 856-7890-544332') }}
            </p>
        </div>

        <!-- Sidebar Navigation Menu -->
        <div class="py-6 space-y-2">
            <!-- Tab: Pesanan Aktif -->
            <a href="#" class="flex items-center justify-between px-4 py-3 rounded-full bg-[#1E1B19] text-white text-sm font-semibold transition-all">
                <div class="flex items-center gap-3">
                    <!-- Clock Icon -->
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Pesanan Aktif</span>
                </div>
                <span class="w-5 h-5 rounded-full bg-[#E35D25] text-white text-[10px] font-bold flex items-center justify-center">3</span>
            </a>

            <!-- Tab: Riwayat -->
            <a href="#" class="flex items-center justify-between px-4 py-3 rounded-full text-[#1E1B19]/60 hover:text-[#1E1B19] hover:bg-[#1E1B19]/5 text-sm font-semibold transition-all">
                <div class="flex items-center gap-3">
                    <!-- History Icon -->
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H17m-.001-4v4h-.002"></path>
                    </svg>
                    <span>Riwayat</span>
                </div>
                <span class="w-5 h-5 rounded-full bg-[#1E1B19]/10 text-[#1E1B19]/60 text-[10px] font-bold flex items-center justify-center">2</span>
            </a>
        </div>

        <!-- Order Button -->
        <div class="pt-4 border-t border-[#1E1B19]/5">
            <a href="{{ request()->is('/') ? '#layanan' : '/#layanan' }}" class="w-full flex items-center justify-center gap-1.5 py-4 px-6 rounded-full bg-[#E35D25] hover:bg-[#c74c1a] text-white text-sm font-semibold transition-all duration-300 shadow-lg shadow-[#E35D25]/15 active:scale-[0.98]">
                <!-- Plus Icon -->
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Pesan Layanan Baru</span>
            </a>
        </div>

    </div>
</div>
