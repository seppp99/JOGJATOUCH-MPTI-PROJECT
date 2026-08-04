@props(['orders' => []])

<div class="flex-grow space-y-6">
    <!-- Header Title -->
    <div>
        <h2 class="font-serif-display text-4xl font-extrabold text-[#1E1B19]">
            Riwayat <span class="text-[#E35D25] italic font-semibold">pesanan</span>
        </h2>
        <p class="text-sm text-[#1E1B19]/50 mt-2">
            Daftar pesanan yang sudah pernah kamu buat sebelumnya.
        </p>
    </div>

    <!-- History List -->
    <div class="space-y-4">
        @php
            // Pill status akhir: selesai = hijau, dibatalkan = merah lembut.
            // Class ditulis sebagai string literal utuh (bukan dirangkai dengan
            // {{ }}) agar terbaca oleh scanner Tailwind & ikut ke CSS build.
            $historyPill = function ($status, $label) {
                return match (strtolower($status)) {
                    'completed', 'selesai'    => ['class' => 'bg-emerald-50 text-emerald-600', 'label' => $label],
                    'canceled', 'dibatalkan' => ['class' => 'bg-rose-50 text-rose-600',       'label' => $label],
                    default      => ['class' => 'bg-gray-100 text-gray-600',      'label' => $label],
                };
            };

            // Ikon chip menyesuaikan jenis layanan (fallback: kunci/servis).
            $iconFor = function ($slug) {
                $slug = strtolower($slug ?? '');
                if (str_contains($slug, 'wifi') || str_contains($slug, 'network')) {
                    return 'M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 011.06 0z';
                }
                if (str_contains($slug, 'rakit') || str_contains($slug, 'pc') || str_contains($slug, 'vga')) {
                    return 'M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 6.75v10.5a2.25 2.25 0 002.25 2.25zm.75-12h9v9h-9v-9z';
                }
                return 'M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085';
            };
        @endphp

        @forelse($orders as $order)
            @php $pill = $historyPill($order->status ?? 'completed', $order->status_label); @endphp
            <!-- History Row Card -->
            <div class="group bg-white rounded-3xl border border-[#1E1B19]/5 p-4 md:p-5 flex items-center gap-4 hover:shadow-xl hover:shadow-neutral-500/5 hover:-translate-y-0.5 transition-all duration-300">
                <!-- Orange Icon Chip -->
                <div class="w-12 h-12 rounded-2xl bg-[#E35D25] text-white flex items-center justify-center shrink-0 shadow-sm shadow-[#E35D25]/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $iconFor($order->layanan_id ?? '') }}"></path>
                    </svg>
                </div>

                <!-- Title + Meta -->
                <div class="min-w-0 flex-grow">
                    <h3 class="font-serif-display text-lg font-bold text-[#1E1B19] truncate group-hover:text-[#E35D25] transition-colors">
                        {{ ucwords(str_replace('-', ' ', $order->layanan_id ?? 'Pesanan')) }}{{ $order->paket_dipilih ? ' — ' . $order->paket_dipilih : '' }}
                    </h3>
                    <p class="text-xs font-medium text-[#1E1B19]/50 mt-0.5">
                        {{ $pill['label'] }} &middot; {{ $order->created_at ? $order->created_at->translatedFormat('d M Y') : 'Tanpa tanggal' }}
                    </p>
                </div>

                <!-- Status Pill -->
                <span class="px-3 py-1 rounded-full {{ $pill['class'] }} text-xs font-bold shrink-0">
                    {{ $pill['label'] }}
                </span>

                <!-- Link Arrow Button -->
                <a href="{{ route('akun.pesanan.detail', $order->order_code) }}" class="w-10 h-10 rounded-full border border-[#1E1B19]/10 bg-white hover:bg-[#E35D25] hover:border-[#E35D25] hover:text-white flex items-center justify-center text-[#1E1B19] shrink-0 transition-all duration-300 group-hover:scale-105 active:scale-95 shadow-sm" title="Lihat Detail Pesanan">
                    <!-- Arrow Right Icon -->
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        @empty
            <!-- Empty State -->
            <div class="bg-white rounded-3xl border border-[#1E1B19]/5 p-12 text-center">
                <!-- Ilustrasi: gugus ikon dokumen + jam di atas awan glow melayang.
                     Ikon statis; interaksi hover ada di awan (.ac-figure:hover). -->
                <div class="ac-figure relative w-44 h-40 mx-auto mb-6 flex items-center justify-center cursor-default">
                    <div class="ac-clouds absolute inset-0" aria-hidden="true">
                        <span class="ac-cloud ac-cloud-a"></span>
                        <span class="ac-cloud ac-cloud-b"></span>
                        <span class="ac-cloud ac-cloud-c"></span>
                    </div>

                    <div class="relative z-10 flex items-end justify-center" aria-hidden="true">
                        <!-- Dokumen -->
                        <svg class="w-16 h-16 text-[#E35D25] shrink-0" fill="none" stroke="currentColor" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <!-- Lembar dokumen -->
                            <rect x="4.5" y="2.5" width="13" height="19" rx="1.5"></rect>
                            <!-- Pita pembatas (bookmark) -->
                            <path d="M9 2.5v5l1.75-1.3L12.5 7.5v-5"></path>
                            <!-- Baris teks -->
                            <path d="M8 13h6"></path>
                            <path d="M8 16h6"></path>
                            <path d="M8 19h3.5"></path>
                        </svg>
                        <!-- Jam (±80% dari ukuran lama, bersebelahan & menyentuh tepi dokumen, tanpa saling timpa;
                             -mb-1 menurunkan jam agar bawahnya sedikit melewati bawah dokumen) -->
                        <svg class="w-8 h-8 -ml-5 -mb-1 text-[#E35D25] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <!-- Interior jam transparan (tanpa alas), latar tembus pandang -->
                            <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <h3 class="font-serif-display text-2xl font-bold text-[#1E1B19] mb-2">Belum ada riwayat</h3>
                <p class="text-sm text-[#1E1B19]/60 max-w-sm mx-auto leading-relaxed">Pesanan yang sudah selesai atau dibatalkan akan muncul di sini.</p>
            </div>
        @endforelse
    </div>
</div>
