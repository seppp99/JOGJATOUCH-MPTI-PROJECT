<x-layouts.app>
    <x-slot:title>
        Detail Pesanan {{ $order->order_code }} — JogjaTouch
    </x-slot:title>

    @php
        $statusColor = match(strtolower($order->status)) {
            'pending' => ['bg' => 'blue-50', 'text' => 'blue-600', 'border' => 'blue-200'],
            'deal' => ['bg' => 'amber-50', 'text' => 'amber-600', 'border' => 'amber-200'],
            'completed' => ['bg' => 'emerald-50', 'text' => 'emerald-600', 'border' => 'emerald-200'],
            'canceled' => ['bg' => 'rose-50', 'text' => 'rose-600', 'border' => 'rose-200'],
            default => ['bg' => 'gray-50', 'text' => 'gray-600', 'border' => 'gray-200'],
        };

        $isCanceled = in_array(strtolower($order->status), ['canceled', 'dibatalkan']);
        $isHistory = in_array(strtolower($order->status), ['completed', 'selesai', 'canceled', 'dibatalkan']);

        $backRoute = $isHistory ? route('akun.riwayat') : route('akun');
        $backLabel = $isHistory ? 'Kembali ke Riwayat Pesanan' : 'Kembali ke Pesanan Aktif';

        $statusOrder = match(strtolower($order->status)) {
            'pending' => 1,
            'deal', 'diproses' => 2,
            'completed', 'selesai' => 3,
            default => 1,
        };

        $adminWa = config('services.whatsapp.admin_number');
        $waText = urlencode("Halo Admin JogjaTouch, saya ingin bertanya tentang pesanan saya dengan kode " . $order->order_code);

        $isUrl = fn($val) => is_string($val) && filter_var($val, FILTER_VALIDATE_URL);
    @endphp

    <main class="min-h-screen bg-[#FBF9F6] py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Dashboard Grid Layout -->
            <div class="flex flex-col md:flex-row gap-8 lg:gap-12 items-start">

                <!-- Left Sidebar Component -->
                <x-dashboard-sidebar :active-count="$activeCount" :history-count="$historyCount" />

                <!-- Right Content / Order Detail Container -->
                <div class="flex-1 w-full space-y-8">

                    <!-- Top Navigation Bar -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <a href="{{ $backRoute }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#1E1B19]/60 hover:text-[#E35D25] transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            <span>{{ $backLabel }}</span>
                        </a>

                        <!-- WhatsApp Admin Button -->
                        <a href="https://wa.me/{{ $adminWa }}?text={{ $waText }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full bg-[#E35D25] hover:bg-[#c74c1a] text-white font-semibold text-sm transition-all duration-200 shadow-sm">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            <span>Hubungi Admin via WhatsApp</span>
                        </a>
                    </div>

                    <!-- Card 1: Header & Timeline Box -->
                    <div class="bg-white border border-[#1E1B19]/5 rounded-3xl p-6 md:p-8 shadow-sm space-y-6">

                        <!-- Order Title & Status Badge Header -->
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-6 border-b border-[#1E1B19]/5">
                            <div class="space-y-1">
                                <div class="flex flex-wrap items-baseline gap-2">
                                    <span class="text-[11px] font-semibold text-[#1E1B19]/40 uppercase tracking-wider">KODE PESANAN</span>
                                    <span class="text-xs font-semibold text-[#1E1B19] tracking-wide">{{ $order->order_code }}</span>
                                </div>
                                <h1 class="font-serif-display text-2xl md:text-3xl font-extrabold text-[#1E1B19]">
                                    {{ ucwords(str_replace('-', ' ', $order->layanan_id)) }}
                                </h1>
                                @if($order->paket_dipilih)
                                    <p class="text-xs font-semibold text-[#E35D25] tracking-wide">
                                        Paket: {{ $order->paket_dipilih }}
                                    </p>
                                @endif
                            </div>

                            <!-- Status Badge -->
                            <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider {{ $statusColor['bg'] }} {{ $statusColor['text'] }} border {{ $statusColor['border'] }}">
                                {{ $order->status_label }}
                            </span>
                        </div>

                        <!-- TIMELINE TRACKER SECTION -->
                        <div>
                            @if($isCanceled)
                                <!-- Canceled Status Notice -->
                                <div class="p-6 rounded-2xl bg-rose-50 border border-rose-200 flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-full bg-rose-500 text-white flex items-center justify-center shrink-0 font-bold">
                                        ✕
                                    </div>
                                    <div class="space-y-1">
                                        <h3 class="font-bold text-rose-900 text-sm">
                                            Pesanan Dibatalkan
                                        </h3>
                                        <p class="text-xs text-rose-700 leading-relaxed">
                                            Pesanan ini telah dibatalkan dan tidak dilanjutkan ke proses berikutnya. Silakan hubungi admin via WhatsApp jika membutuhkan bantuan atau keterangan lebih lanjut.
                                        </p>
                                    </div>
                                </div>
                            @else
                                <!-- 3-Step Normal Flow Tracker (Menunggu Konfirmasi -> Diproses -> Selesai) -->
                                <div class="py-8 px-2 sm:px-6">
                                    <div class="flex items-start justify-between">

                                        <!-- Step 1: Menunggu Konfirmasi -->
                                        <div class="flex flex-col items-center text-center w-20 sm:w-28 shrink-0">
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs {{ $statusOrder >= 1 ? 'bg-[#E35D25] text-white shadow-md' : 'bg-[#1E1B19]/10 text-[#1E1B19]/40' }} border-2 border-white transition-all duration-500">
                                                {{ $statusOrder > 1 ? '✓' : '1' }}
                                            </div>
                                            <span class="text-[11px] {{ $statusOrder >= 1 ? 'font-bold text-[#1E1B19]' : 'font-semibold text-[#1E1B19]/40' }} mt-3">Menunggu Konfirmasi</span>
                                        </div>

                                        <!-- Segment 1: Tahap 1-2 -->
                                        <div class="flex-1 h-1 mx-2 sm:mx-4 rounded-full mt-3.5 transition-colors duration-500 {{ $statusOrder >= 2 ? 'bg-[#E35D25]' : 'bg-[#1E1B19]/10' }}"></div>

                                        <!-- Step 2: Diproses -->
                                        <div class="flex flex-col items-center text-center w-20 sm:w-28 shrink-0">
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs {{ $statusOrder >= 2 ? 'bg-[#E35D25] text-white shadow-md' : 'bg-[#1E1B19]/10 text-[#1E1B19]/40' }} border-2 border-white transition-all duration-500">
                                                {{ $statusOrder > 2 ? '✓' : '2' }}
                                            </div>
                                            <span class="text-[11px] {{ $statusOrder >= 2 ? 'font-bold text-[#1E1B19]' : 'font-semibold text-[#1E1B19]/40' }} mt-3">Diproses</span>
                                        </div>

                                        <!-- Segment 2: Tahap 2-3 -->
                                        <div class="flex-1 h-1 mx-2 sm:mx-4 rounded-full mt-3.5 transition-colors duration-500 {{ $statusOrder >= 3 ? 'bg-[#E35D25]' : 'bg-[#1E1B19]/10' }}"></div>

                                        <!-- Step 3: Selesai -->
                                        <div class="flex flex-col items-center text-center w-20 sm:w-28 shrink-0">
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs {{ $statusOrder >= 3 ? 'bg-[#E35D25] text-white shadow-md' : 'bg-[#1E1B19]/10 text-[#1E1B19]/40' }} border-2 border-white transition-all duration-500">
                                                {{ $statusOrder >= 3 ? '✓' : '3' }}
                                            </div>
                                            <span class="text-[11px] {{ $statusOrder >= 3 ? 'font-bold text-[#1E1B19]' : 'font-semibold text-[#1E1B19]/40' }} mt-3">Selesai</span>
                                        </div>

                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>

                    <!-- Card 2: Rincian Pesanan -->
                    <div class="bg-white border border-[#1E1B19]/5 rounded-3xl p-6 md:p-8 shadow-sm space-y-6">
                        <h2 class="font-serif-display text-xl font-bold text-[#1E1B19]">
                            Rincian Pesanan
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Detail Kebutuhan -->
                            <div class="md:col-span-2 p-4 rounded-2xl bg-[#FBF9F6] border border-[#1E1B19]/5 space-y-1">
                                <span class="text-xs font-semibold text-[#1E1B19]/50 uppercase tracking-wider block">Masalah / Detail Kebutuhan</span>
                                <p class="text-sm text-[#1E1B19] leading-relaxed">
                                    {{ $order->detail_kebutuhan ?? 'Tidak ada deskripsi' }}
                                </p>
                            </div>

                            <!-- Harga Sepakat -->
                            <div class="p-4 rounded-2xl bg-[#FBF9F6] border border-[#1E1B19]/5 space-y-1">
                                <span class="text-xs font-semibold text-[#1E1B19]/50 uppercase tracking-wider block">Harga Sepakat</span>
                                <p class="text-base font-bold text-[#1E1B19]">
                                    {{ $order->harga_fix ? 'Rp ' . number_format($order->harga_fix, 0, ',', '.') : 'Menunggu penawaran' }}
                                </p>
                            </div>

                            <!-- Tanggal Pelaksanaan -->
                            <div class="p-4 rounded-2xl bg-[#FBF9F6] border border-[#1E1B19]/5 space-y-1">
                                <span class="text-xs font-semibold text-[#1E1B19]/50 uppercase tracking-wider block">Tanggal Pelaksanaan</span>
                                <p class="text-base font-medium text-[#1E1B19]">
                                    {{ $order->tanggal_pelaksanaan ? $order->tanggal_pelaksanaan->translatedFormat('d M Y') : 'Belum dijadwalkan' }}
                                </p>
                            </div>

                            <!-- Tanggal Pemesanan -->
                            <div class="p-4 rounded-2xl bg-[#FBF9F6] border border-[#1E1B19]/5 space-y-1 md:col-span-2">
                                <span class="text-xs font-semibold text-[#1E1B19]/50 uppercase tracking-wider block">Tanggal Pemesanan</span>
                                <p class="text-sm font-medium text-[#1E1B19]/80">
                                    {{ $order->created_at ? $order->created_at->translatedFormat('d M Y, H:i') . ' WIB' : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Spesifikasi (custom_fields) -->
                    @if(!empty($order->custom_fields) && is_array($order->custom_fields) && count($order->custom_fields) > 0)
                        <div class="bg-white border border-[#1E1B19]/5 rounded-3xl p-6 md:p-8 shadow-sm space-y-6">
                            <h2 class="font-serif-display text-xl font-bold text-[#1E1B19]">
                                Spesifikasi Pesanan
                            </h2>

                            <div class="divide-y divide-[#1E1B19]/5 border border-[#1E1B19]/5 rounded-2xl overflow-hidden">
                                @foreach($order->custom_fields as $key => $val)
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 bg-white hover:bg-[#FBF9F6]/50 transition-colors gap-2">
                                        <span class="text-xs font-semibold text-[#1E1B19]/60 uppercase tracking-wider">
                                            {{ ucwords(str_replace('_', ' ', $key)) }}
                                        </span>
                                        <div class="text-sm font-medium text-[#1E1B19] sm:text-right">
                                            @if($isUrl($val))
                                                <a href="{{ $val }}" target="_blank" rel="noopener noreferrer" class="text-[#E35D25] hover:underline break-all">
                                                    {{ $val }}
                                                </a>
                                            @else
                                                {{ $val ?: '-' }}
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Card 4: Data Pemesan -->
                    <div class="bg-white border border-[#1E1B19]/5 rounded-3xl p-6 md:p-8 shadow-sm space-y-6">
                        <h2 class="font-serif-display text-xl font-bold text-[#1E1B19]">
                            Informasi Pemesan
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Lengkap -->
                            <div class="p-4 rounded-2xl bg-[#FBF9F6] border border-[#1E1B19]/5 space-y-1">
                                <span class="text-xs font-semibold text-[#1E1B19]/50 uppercase tracking-wider block">Nama Pelanggan</span>
                                <p class="text-sm font-semibold text-[#1E1B19]">
                                    {{ $order->nama_pelanggan }}
                                </p>
                            </div>

                            <!-- WhatsApp Number -->
                            <div class="p-4 rounded-2xl bg-[#FBF9F6] border border-[#1E1B19]/5 space-y-1">
                                <span class="text-xs font-semibold text-[#1E1B19]/50 uppercase tracking-wider block">WhatsApp</span>
                                <p class="text-sm font-medium text-[#1E1B19]">
                                    {{ $order->whatsapp_number }}
                                </p>
                            </div>

                            <!-- Email -->
                            <div class="p-4 rounded-2xl bg-[#FBF9F6] border border-[#1E1B19]/5 space-y-1 {{ $order->alamat ? '' : 'md:col-span-2' }}">
                                <span class="text-xs font-semibold text-[#1E1B19]/50 uppercase tracking-wider block">Email</span>
                                <p class="text-sm font-medium text-[#1E1B19]">
                                    {{ $order->email }}
                                </p>
                            </div>

                            <!-- Alamat (Hanya tampil jika ada) -->
                            @if($order->alamat)
                                <div class="p-4 rounded-2xl bg-[#FBF9F6] border border-[#1E1B19]/5 space-y-1">
                                    <span class="text-xs font-semibold text-[#1E1B19]/50 uppercase tracking-wider block">Alamat</span>
                                    <p class="text-sm font-medium text-[#1E1B19]">
                                        {{ $order->alamat }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
                <!-- End Right Content -->

            </div>

        </div>
    </main>
</x-layouts.app>
