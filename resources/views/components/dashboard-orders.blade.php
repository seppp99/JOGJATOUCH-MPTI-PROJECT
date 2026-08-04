@props(['orders' => []])

{{-- Ilustrasi empty-state memakai kelas .ac-* dari resources/css/app.css
     (dipakai bersama dengan dashboard-history). --}}
<div class="flex-grow space-y-6">
    <!-- Header Title -->
    <div>
        <h2 class="font-serif-display text-4xl font-extrabold text-[#1E1B19]">
            Pesanan <span class="text-[#E35D25] italic font-semibold">aktif</span>
        </h2>
        <p class="text-sm text-[#1E1B19]/50 mt-2">
            Semua pesanan yang sedang berlangsung. Klik untuk melihat timeline lengkap.
        </p>
    </div>

    <!-- Active Orders List -->
    <div class="space-y-4">
        @php
            // Helper function to get status badge color
            $getStatusColor = function($status) {
                return match(strtolower($status)) {
                    'pending' => ['bg' => 'blue-50', 'text' => 'blue-600'],
                    'deal' => ['bg' => 'amber-50', 'text' => 'amber-600'],
                    'completed' => ['bg' => 'emerald-50', 'text' => 'emerald-600'],
                    'canceled' => ['bg' => 'rose-50', 'text' => 'rose-600'],
                    default => ['bg' => 'gray-50', 'text' => 'gray-600'],
                };
            };
        @endphp

        @forelse($orders as $order)
            @php
                $statusColor = $getStatusColor($order->status ?? 'pending');
            @endphp
            <!-- Dynamic Order Card -->
            <div class="group bg-white rounded-3xl border border-[#1E1B19]/5 p-6 md:p-8 flex items-center justify-between hover:shadow-xl hover:shadow-neutral-500/5 hover:-translate-y-0.5 transition-all duration-300">
                <div class="space-y-4 pr-4">
                    <!-- Meta Info / Badges -->
                    <div class="flex flex-wrap items-center gap-2 text-xs font-semibold">
                        <span class="text-[#1E1B19]/50">{{ $order->order_code }}</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-[#1E1B19]/20"></span>
                        <!-- Status Badge -->
                        <span class="px-2.5 py-0.5 rounded-full bg-{{ $statusColor['bg'] }} text-{{ $statusColor['text'] }} text-[10px] font-bold tracking-wide uppercase">
                            {{ $order->status_label }}
                        </span>
                    </div>

                    <!-- Order Content -->
                    <div class="space-y-1.5">
                        <h3 class="font-serif-display text-2xl font-bold text-[#1E1B19] group-hover:text-[#E35D25] transition-colors">
                            {{ ucwords(str_replace('-', ' ', $order->layanan_id)) }}
                        </h3>
                        @if($order->paket_dipilih)
                            <p class="text-xs font-semibold text-[#E35D25]">
                                {{ $order->paket_dipilih }}
                            </p>
                        @endif
                        <p class="text-sm text-[#1E1B19]/60 leading-relaxed max-w-2xl">
                            {{ $order->detail_kebutuhan ?? 'Tidak ada deskripsi' }}
                        </p>
                    </div>

                    <!-- Footer details (Price & Date) -->
                    <div class="flex items-center gap-3 text-sm text-[#1E1B19]/80">
                        <span class="font-bold text-[#1E1B19]">{{ $order->harga_fix ? 'Rp ' . number_format($order->harga_fix, 0, ',', '.') : 'Menunggu penawaran' }}</span>
                        <span class="text-[#1E1B19]/30">|</span>
                        <span class="font-medium text-[#1E1B19]/50">{{ $order->created_at ? $order->created_at->translatedFormat('d M Y') : 'Tanpa tanggal' }}@if($order->tanggal_pelaksanaan) &middot; <span class="text-[#E35D25] font-semibold">Jadwal: {{ $order->tanggal_pelaksanaan->translatedFormat('d M Y') }}</span>@endif</span>
                    </div>
                </div>

                <!-- Link Arrow Button -->
                <a href="{{ route('akun.pesanan.detail', $order->order_code) }}" class="w-12 h-12 rounded-full border border-[#1E1B19]/10 bg-white hover:bg-[#E35D25] hover:border-[#E35D25] hover:text-white flex items-center justify-center text-[#1E1B19] shrink-0 transition-all duration-300 group-hover:scale-105 active:scale-95 shadow-sm" title="Lihat Detail Pesanan">
                    <!-- Arrow Right Icon -->
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        @empty
            <!-- Empty State -->
            <div class="bg-white rounded-3xl border border-[#1E1B19]/5 p-12 text-center">
                <!-- Ilustrasi: gugus ikon PC + router di atas awan glow melayang.
                     Ikon statis (tanpa hover); interaksi hover ada di awan (.ac-figure:hover). -->
                <div class="ac-figure relative w-44 h-40 mx-auto mb-6 flex items-center justify-center cursor-default">
                    <div class="ac-clouds absolute inset-0" aria-hidden="true">
                        <span class="ac-cloud ac-cloud-a"></span>
                        <span class="ac-cloud ac-cloud-b"></span>
                        <span class="ac-cloud ac-cloud-c"></span>
                    </div>

                    <div class="relative z-10" aria-hidden="true">
                        <!-- Monitor / PC (stroke ditipiskan agar setebal router secara visual) -->
                        <svg class="w-16 h-16 text-[#E35D25]" fill="none" stroke="currentColor" stroke-width="1.1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"></path>
                        </svg>
                        <!-- Router (tanpa lingkaran) -->
                        <svg class="w-11 h-11 text-[#E35D25] absolute -bottom-[10px] -right-[14px]" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <!-- Badan router -->
                            <rect x="3" y="13.5" width="18" height="6" rx="1.5"></rect>
                            <!-- Antena -->
                            <path d="M7.5 13.5l-1.5-5"></path>
                            <path d="M16.5 13.5l1.5-5"></path>
                            <!-- Lampu indikator -->
                            <path d="M6.5 16.5h.01"></path>
                            <path d="M9.5 16.5h.01"></path>
                            <path d="M15.5 16.5h2.5"></path>
                        </svg>
                    </div>
                </div>

                <h3 class="font-serif-display text-2xl font-bold text-[#1E1B19] mb-2">Belum ada pesanan</h3>
                <p class="text-sm text-[#1E1B19]/60 max-w-sm mx-auto leading-relaxed">Mulai pesan layanan kami sekarang untuk melihat pesanan kamu di sini.</p>
            </div>
        @endforelse

    </div>
</div>
