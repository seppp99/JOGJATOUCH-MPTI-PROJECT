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
            // Get current user's WhatsApp for filtering orders
            $userWhatsapp = session('user.whatsapp');
            $ordersDb = session('orders_db', []);
            
            // Filter orders for current user
            $userOrders = array_filter($ordersDb, function($order) use ($userWhatsapp) {
                return isset($order['no_whatsapp']) && $order['no_whatsapp'] === $userWhatsapp;
            });
            
            // Helper function to get status badge color
            $getStatusColor = function($status) {
                return match($status) {
                    'dikerjakan' => ['bg' => 'indigo-50', 'text' => 'indigo-600'],
                    'diproses' => ['bg' => 'amber-50', 'text' => 'amber-600'],
                    'masuk' => ['bg' => 'blue-50', 'text' => 'blue-600'],
                    default => ['bg' => 'gray-50', 'text' => 'gray-600'],
                };
            };
            
            $getPaymentColor = function($status) {
                return match($status) {
                    'lunas' => ['bg' => 'emerald-50', 'text' => 'emerald-600'],
                    'dp' => ['bg' => 'orange-50', 'text' => 'orange-600'],
                    'belum_bayar' => ['bg' => 'rose-50', 'text' => 'rose-600'],
                    default => ['bg' => 'gray-50', 'text' => 'gray-600'],
                };
            };
        @endphp
        
        @forelse($userOrders as $order)
            @php
                $statusColor = $getStatusColor(strtolower($order['status'] ?? 'masuk'));
                $paymentColor = $getPaymentColor(strtolower($order['payment_status'] ?? 'belum_bayar'));
            @endphp
            <!-- Dynamic Order Card -->
            <div class="group bg-white rounded-3xl border border-[#1E1B19]/5 p-6 md:p-8 flex items-center justify-between hover:shadow-xl hover:shadow-neutral-500/5 hover:-translate-y-0.5 transition-all duration-300">
                <div class="space-y-4 pr-4">
                    <!-- Meta Info / Badges -->
                    <div class="flex flex-wrap items-center gap-2 text-xs font-semibold">
                        <span class="text-[#1E1B19]/50">JT-2026-{{ str_pad($order['id'], 4, '0', STR_PAD_LEFT) }}</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-[#1E1B19]/20"></span>
                        <!-- Status Badge -->
                        <span class="px-2.5 py-0.5 rounded-full bg-{{ $statusColor['bg'] }} text-{{ $statusColor['text'] }} text-[10px] font-bold tracking-wide uppercase">
                            {{ strtoupper($order['status'] ?? 'MASUK') }}
                        </span>
                        <!-- Payment Status Badge -->
                        <span class="px-2.5 py-0.5 rounded-full bg-{{ $paymentColor['bg'] }} text-{{ $paymentColor['text'] }} text-[10px] font-bold tracking-wide uppercase">
                            {{ strtoupper(str_replace('_', ' ', $order['payment_status'] ?? 'BELUM BAYAR')) }}
                        </span>
                    </div>

                    <!-- Order Content -->
                    <div class="space-y-1.5">
                        <h3 class="font-serif-display text-2xl font-bold text-[#1E1B19] group-hover:text-[#E35D25] transition-colors">
                            {{ ucfirst(str_replace('-', ' ', $order['service_slug'])) }}
                        </h3>
                        <p class="text-sm text-[#1E1B19]/60 leading-relaxed max-w-2xl">
                            {{ $order['masalah_utama'] ?? 'Tidak ada deskripsi' }}
                        </p>
                    </div>

                    <!-- Footer details (Price & Date) -->
                    <div class="flex items-center gap-3 text-sm text-[#1E1B19]/80">
                        <span class="font-bold text-[#1E1B19]">Rp {{ $order['price'] ?? 'Hubungi kami' }}</span>
                        <span class="text-[#1E1B19]/30">|</span>
                        <span class="font-medium text-[#1E1B19]/50">{{ $order['date'] ?? 'Tanpa tanggal' }}</span>
                    </div>
                </div>
                
                <!-- Link Arrow Button -->
                <a href="#" class="w-12 h-12 rounded-full border border-[#1E1B19]/10 bg-white hover:bg-[#E35D25] hover:border-[#E35D25] hover:text-white flex items-center justify-center text-[#1E1B19] shrink-0 transition-all duration-300 group-hover:scale-105 active:scale-95 shadow-sm">
                    <!-- Arrow Right Icon -->
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        @empty
            <!-- Empty State -->
            <div class="bg-gradient-to-br from-[#FBF9F6] to-[#F5EFEA] rounded-3xl border border-[#1E1B19]/5 p-12 text-center">
                <div class="w-16 h-16 bg-[#E35D25]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-[#E35D25]/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                </div>
                <h3 class="font-serif-display text-xl font-semibold text-[#1E1B19] mb-2">Belum ada pesanan</h3>
                <p class="text-sm text-[#1E1B19]/60 mb-6">Mulai pesan layanan kami sekarang untuk melihat pesanan Anda di sini.</p>
                <a href="/#layanan" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#E35D25] text-white text-sm font-semibold hover:bg-[#c74c1a] transition-colors">
                    <span>Jelajahi Layanan</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        @endforelse

    </div>
</div>
