<!-- SECTION 8: INTERACTIVE ORDER STATUS TRACKER -->
<section id="tracking" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        
        <!-- Heading -->
        <div class="text-center max-w-xl mx-auto mb-16">
            <span class="text-xs font-bold text-[#E35D25] tracking-widest uppercase block mb-4">PELACAKAN REAL-TIME</span>
            <h2 class="font-serif-display text-4xl md:text-5xl font-semibold tracking-tight text-[#1E1B19] mb-4">
                Cek <span class="italic text-[#E35D25] font-serif-display">status pesanan</span> Anda.
            </h2>
            <p class="text-sm text-[#1E1B19]/70">
                Gunakan kolom interaktif di bawah untuk melacak kemajuan pengerjaan PC rakitan, desain, atau hasil cetak Anda secara real-time.
            </p>
        </div>

        <!-- Tracker Widget Container -->
        <div class="max-w-2xl mx-auto bg-[#FBF9F6] border border-[#1E1B19]/5 rounded-3xl p-6 md:p-8 shadow-xl shadow-black/5">
            
            <!-- Search Input Bar -->
            <div class="flex flex-col sm:flex-row gap-3 mb-8">
                <div class="relative flex-1">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-[#1E1B19]/40" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input 
                        type="text" 
                        id="tracking-input" 
                        class="w-full pl-12 pr-4 py-4 rounded-full bg-white border border-[#1E1B19]/10 text-sm font-medium focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all" 
                        placeholder="Masukkan kode tracking pesanan... (Contoh: TJ-2026-0412)"
                        value="TJ-2026-0412"
                    >
                </div>
                <button 
                    id="tracking-search-btn"
                    class="px-8 py-4 rounded-full bg-[#1E1B19] hover:bg-[#332e2c] text-white font-semibold text-sm transition-colors duration-200 active:scale-98"
                >
                    Cek Status
                </button>
            </div>

            <!-- Dynamic Results Output Box -->
            <div id="tracker-result-box" class="transition-all duration-300 opacity-100">
                <!-- Active Tracking Detail Card -->
                <div class="bg-white border border-[#1E1B19]/5 rounded-2xl p-6 md:p-8 shadow-sm">
                    
                    <!-- Header Info -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 pb-6 border-b border-[#1E1B19]/5 mb-6">
                        <div>
                            <span class="text-xs font-semibold text-[#1E1B19]/55 block uppercase tracking-wider">Nomor Pesanan</span>
                            <h3 id="result-order-id" class="text-lg font-extrabold text-[#1E1B19] tracking-tight">TJ-2026-0412</h3>
                        </div>
                        <div class="px-4 py-1.5 rounded-full text-xs font-bold text-[#E35D25] bg-[#E35D25]/10 border border-[#E35D25]/20 uppercase tracking-wider" id="result-status-badge">
                            Proses Pengerjaan
                        </div>
                    </div>

                    <!-- Visual Step Progress Tracker -->
                    <div class="relative py-8 mb-6">
                        <!-- Background Line -->
                        <div class="absolute top-[37px] left-8 right-8 h-1 bg-[#1E1B19]/5 rounded-full z-0"></div>
                        
                        <!-- Active Fill Line -->
                        <div id="tracker-progress-line" class="absolute top-[37px] left-8 h-1 bg-[#E35D25] rounded-full z-0 transition-all duration-700" style="width: 33.33%;"></div>

                        <!-- Stepper Step Elements -->
                        <div class="relative z-10 flex justify-between">
                            
                            <!-- Step 1: Diterima -->
                            <div class="flex flex-col items-center">
                                <div id="step-dot-1" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-[#E35D25] text-white shadow-md border-2 border-white transition-all duration-500">
                                    ✓
                                </div>
                                <span class="text-[11px] font-bold text-[#1E1B19] mt-3">Diterima</span>
                            </div>

                            <!-- Step 2: Proses Pengerjaan -->
                            <div class="flex flex-col items-center">
                                <div id="step-dot-2" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-[#E35D25] text-white shadow-md border-2 border-white transition-all duration-500">
                                    2
                                </div>
                                <span class="text-[11px] font-bold text-[#1E1B19] mt-3">Pengerjaan</span>
                            </div>

                            <!-- Step 3: Selesai -->
                            <div class="flex flex-col items-center">
                                <div id="step-dot-3" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-[#1E1B19]/10 text-[#1E1B19]/40 border-2 border-white transition-all duration-500">
                                    3
                                </div>
                                <span class="text-[11px] font-semibold text-[#1E1B19]/40 mt-3">Selesai</span>
                            </div>

                            <!-- Step 4: Diambil -->
                            <div class="flex flex-col items-center">
                                <div id="step-dot-4" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-[#1E1B19]/10 text-[#1E1B19]/40 border-2 border-white transition-all duration-500">
                                    4
                                </div>
                                <span class="text-[11px] font-semibold text-[#1E1B19]/40 mt-3">Diambil</span>
                            </div>

                        </div>
                    </div>

                    <!-- Status Description Footer Text -->
                    <div class="bg-[#FBF9F6] border border-[#1E1B19]/5 rounded-xl p-4 flex gap-3 items-start mt-6">
                        <svg class="w-5 h-5 text-[#E35D25] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-xs text-[#1E1B19]/75 leading-relaxed">
                            <span class="font-bold text-[#1E1B19] block mb-1">Pembaruan Terakhir:</span>
                            <p id="result-status-text">PC Gaming Custom sedang dirakit dan diuji oleh teknisi senior kami. Kabel manajemen rapi dan instalasi driver terbaru berjalan normal.</p>
                            <span class="text-[10px] text-[#1E1B19]/50 block mt-2" id="result-time-text">Pembaruan: 20 Mei 2026, 15:45 WIB</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>

@push('scripts')
<script>
    // Interactive Order Status Tracker Search Database
    const trackingData = {
        'TJ-2026-0412': {
            orderId: 'TJ-2026-0412',
            status: 'Proses Pengerjaan',
            progress: '33.33%',
            step: 2,
            text: 'PC Gaming Custom sedang dirakit dan diuji oleh teknisi senior kami. Kabel manajemen rapi dan instalasi driver terbaru berjalan normal.',
            time: 'Pembaruan terakhir: 20 Mei 2026, 15:45 WIB'
        },
        'TJ-2026-0500': {
            orderId: 'TJ-2026-0500',
            status: 'Diterima',
            progress: '0%',
            step: 1,
            text: 'Pesanan Anda (Jasa Desain Logo Branding) telah kami terima. Kami sedang melakukan analisis brand guide awal sebelum mulai merancang draf.',
            time: 'Pembaruan terakhir: 20 Mei 2026, 09:12 WIB'
        },
        'TJ-2026-0390': {
            orderId: 'TJ-2026-0390',
            status: 'Selesai Pengerjaan',
            progress: '66.66%',
            step: 3,
            text: 'Pengerjaan cetak spanduk promosi dan id card panitia telah selesai dengan kualitas warna yang tajam. Saat ini masuk tahap pengepakan rapi.',
            time: 'Pembaruan terakhir: 19 Mei 2026, 17:30 WIB'
        },
        'TJ-2026-0350': {
            orderId: 'TJ-2026-0350',
            status: 'Sudah Diambil',
            progress: '100%',
            step: 4,
            text: 'Pesanan PC Office Rakitan & Upgrade SSD Laptop telah selesai dikerjakan dan sudah diambil oleh pemilik pada tanggal 18 Mei 2026. Garansi berlaku 3 bulan.',
            time: 'Pembaruan terakhir: 18 Mei 2026, 11:20 WIB'
        }
    };

    const searchInput = document.getElementById('tracking-input');
    const searchBtn = document.getElementById('tracking-search-btn');
    const resultBox = document.getElementById('tracker-result-box');

    searchBtn.addEventListener('click', performSearch);
    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            performSearch();
        }
    });

    function performSearch() {
        const code = searchInput.value.trim().toUpperCase();
        
        // Add search transition effects
        resultBox.style.opacity = '0';
        
        setTimeout(() => {
            if (trackingData[code]) {
                const data = trackingData[code];
                
                // Populate results dynamically
                resultBox.innerHTML = `
                    <div class="bg-white border border-[#1E1B19]/5 rounded-2xl p-6 md:p-8 shadow-sm">
                        
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 pb-6 border-b border-[#1E1B19]/5 mb-6">
                            <div>
                                <span class="text-xs font-semibold text-[#1E1B19]/55 block uppercase tracking-wider">Nomor Pesanan</span>
                                <h3 id="result-order-id" class="text-lg font-extrabold text-[#1E1B19] tracking-tight">${data.orderId}</h3>
                            </div>
                            <div class="px-4 py-1.5 rounded-full text-xs font-bold text-[#E35D25] bg-[#E35D25]/10 border border-[#E35D25]/20 uppercase tracking-wider" id="result-status-badge">
                                ${data.status}
                            </div>
                        </div>

                        <div class="relative py-8 mb-6">
                            <div class="absolute top-[37px] left-8 right-8 h-1 bg-[#1E1B19]/5 rounded-full z-0"></div>
                            <div id="tracker-progress-line" class="absolute top-[37px] left-8 h-1 bg-[#E35D25] rounded-full z-0 transition-all duration-700" style="width: ${data.progress};"></div>

                            <div class="relative z-10 flex justify-between">
                                <div class="flex flex-col items-center">
                                    <div id="step-dot-1" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs ${data.step >= 1 ? 'bg-[#E35D25] text-white shadow-md border-2 border-white' : 'bg-[#1E1B19]/10 text-[#1E1B19]/40 border-2 border-white'} transition-all duration-500">
                                        ${data.step > 1 ? '✓' : '1'}
                                    </div>
                                    <span class="text-[11px] ${data.step >= 1 ? 'font-bold text-[#1E1B19]' : 'font-semibold text-[#1E1B19]/40'} mt-3">Diterima</span>
                                </div>

                                <div class="flex flex-col items-center">
                                    <div id="step-dot-2" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs ${data.step >= 2 ? 'bg-[#E35D25] text-white shadow-md border-2 border-white' : 'bg-[#1E1B19]/10 text-[#1E1B19]/40 border-2 border-white'} transition-all duration-500">
                                        ${data.step > 2 ? '✓' : '2'}
                                    </div>
                                    <span class="text-[11px] ${data.step >= 2 ? 'font-bold text-[#1E1B19]' : 'font-semibold text-[#1E1B19]/40'} mt-3">Pengerjaan</span>
                                </div>

                                <div class="flex flex-col items-center">
                                    <div id="step-dot-3" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs ${data.step >= 3 ? 'bg-[#E35D25] text-white shadow-md border-2 border-white' : 'bg-[#1E1B19]/10 text-[#1E1B19]/40 border-2 border-white'} transition-all duration-500">
                                        ${data.step > 3 ? '✓' : '3'}
                                    </div>
                                    <span class="text-[11px] ${data.step >= 3 ? 'font-bold text-[#1E1B19]' : 'font-semibold text-[#1E1B19]/40'} mt-3">Selesai</span>
                                </div>

                                <div class="flex flex-col items-center">
                                    <div id="step-dot-4" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs ${data.step >= 4 ? 'bg-[#E35D25] text-white shadow-md border-2 border-white' : 'bg-[#1E1B19]/10 text-[#1E1B19]/40 border-2 border-white'} transition-all duration-500">
                                        4
                                    </div>
                                    <span class="text-[11px] ${data.step >= 4 ? 'font-bold text-[#1E1B19]' : 'font-semibold text-[#1E1B19]/40'} mt-3">Diambil</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-[#FBF9F6] border border-[#1E1B19]/5 rounded-xl p-4 flex gap-3 items-start mt-6">
                            <svg class="w-5 h-5 text-[#E35D25] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-xs text-[#1E1B19]/75 leading-relaxed">
                                <span class="font-bold text-[#1E1B19] block mb-1">Pembaruan Terakhir:</span>
                                <p id="result-status-text">${data.text}</p>
                                <span class="text-[10px] text-[#1E1B19]/50 block mt-2" id="result-time-text">${data.time}</span>
                            </div>
                        </div>

                    </div>
                `;
            } else {
                // Not Found State
                resultBox.innerHTML = `
                    <div class="bg-red-50/50 border border-red-200/50 rounded-2xl p-8 text-center flex flex-col items-center justify-center">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center text-red-600 mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-red-900 mb-1">Kode Pesanan Tidak Ditemukan</h3>
                        <p class="text-xs text-red-700/80 max-w-sm mb-4">
                            Mohon periksa kembali kode tracking yang Anda masukkan. Pastikan sesuai dengan kode yang tertera pada nota transaksi Anda.
                        </p>
                        <div class="text-[10px] bg-red-100/50 text-red-800 px-3 py-1 rounded-md font-semibold font-mono">
                            Contoh valid: TJ-2026-0412, TJ-2026-0500, TJ-2026-0390
                        </div>
                    </div>
                `;
            }
            resultBox.style.opacity = '1';
        }, 300);
    }
</script>
@endpush
