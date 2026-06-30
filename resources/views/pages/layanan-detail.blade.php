<x-layouts.app>
    <x-slot name="title">
        {{ $service['title_prefix'] }} {{ str_replace('.', '', $service['title_italic']) }} — Jogjatouch
    </x-slot>

    <div class="py-16 md:py-24 bg-[#FBF9F6] min-h-screen">
        <div class="max-w-7xl mx-auto px-6">
            
            <!-- Breadcrumbs / Top Actions -->
            <div class="flex items-center space-x-4 mb-8">
                <a href="{{ url('/#layanan') }}" class="inline-flex items-center text-xs font-semibold uppercase tracking-wider text-[#1E1B19]/60 hover:text-[#E35D25] transition-colors duration-200 bg-white px-4 py-2.5 rounded-full border border-[#eee] shadow-sm">
                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Layanan
                </a>
                <span class="w-1.5 h-1.5 rounded-full bg-[#E35D25]"></span>
                <span class="text-[10px] tracking-[0.25em] font-bold uppercase text-[#E35D25]">{{ $service['category_label'] }}</span>
            </div>

            <!-- Page Title Header -->
            <div class="mb-16 max-w-3xl">
                <h1 class="font-serif-display text-5xl md:text-7xl font-semibold text-[#1E1B19] leading-[1.08] tracking-tight">
                    {{ $service['title_prefix'] }} <span class="italic text-[#E35D25] font-serif">{{ $service['title_italic'] }}</span>
                </h1>
                <p class="text-[#1E1B19]/70 text-lg md:text-xl mt-6 leading-relaxed">
                    {{ $service['description'] }}
                </p>
            </div>

            <!-- Success Alert State -->
            @if(session('success_order'))
                <div class="mb-12 bg-emerald-50 border border-emerald-200 rounded-3xl p-8 max-w-4xl shadow-sm animate-fade-in">
                    <div class="flex items-start space-x-5">
                        <div class="p-3 bg-emerald-500 rounded-full text-white shadow-md shadow-emerald-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-[#1E1B19] mb-2">Request Permintaan Terkirim!</h3>
                            <p class="text-sm text-emerald-800/90 leading-relaxed mb-6">
                                Terima kasih <strong>{{ session('success_order')['nama'] }}</strong>. Kami telah menerima permintaan Anda untuk paket <strong>{{ session('success_order')['package'] }}</strong>. Tim konsultan kami akan menghubungi Anda melalui WhatsApp (<strong>{{ session('success_order')['whatsapp'] }}</strong>) atau Email (<strong>{{ session('success_order')['email'] }}</strong>) dalam kurun waktu 1x24 jam untuk menjadwalkan konsultasi awal gratis.
                            </p>
                            
                            @if(session('success_order')['database_ready'])
                                <div class="inline-flex items-center space-x-2 bg-emerald-100/70 border border-emerald-300/40 text-emerald-900 px-4 py-2 rounded-xl text-xs font-semibold">
                                    <span class="w-2 h-2 rounded-full bg-emerald-600 animate-ping"></span>
                                    <span>Tersimpan di Database (Production Ready)</span>
                                </div>
                            @else
                                <div class="inline-flex items-center space-x-2 bg-amber-50 border border-amber-200 text-amber-900 px-4 py-2 rounded-xl text-xs font-semibold">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                    <span>Preview Mode: Form Siap & Validasi Aktif (Tinggal Hubungkan DB)</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Main Dynamic Grid: Services on Left, Form on Right -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- LEFT COLUMN: PACKAGES -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="mb-4">
                        <h2 class="font-serif-display text-3xl font-semibold text-[#1E1B19]">Pilih jenis layanan</h2>
                        <p class="text-sm text-[#1E1B19]/60 mt-2">Mulai dari pengerjaan ringan hingga perombakan total infrastruktur.</p>
                    </div>

                    <!-- Package Selectors -->
                    <div class="space-y-4" id="package-container">
                        @foreach($service['options'] as $index => $option)
                            <div 
                                onclick="selectPackage('{{ $option['name'] }}', '{{ $option['id'] }}', {{ $index }})" 
                                id="card-{{ $option['id'] }}"
                                class="package-card relative p-6 md:p-8 rounded-[24px] bg-white border-2 cursor-pointer transition-all duration-300 hover:shadow-md select-none group
                                {{ $index === 0 ? 'border-[#E35D25] shadow-sm' : 'border-[#eee]' }}"
                            >
                                <!-- Interactive Circle Indicator -->
                                <div class="absolute top-6 md:top-8 right-6 md:right-8">
                                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center transition-all duration-200
                                        {{ $index === 0 ? 'border-[#E35D25]' : 'border-[#ccc] group-hover:border-[#E35D25]/60' }}"
                                        id="radio-outer-{{ $option['id'] }}"
                                    >
                                        <div class="w-3 h-3 rounded-full bg-[#E35D25] transition-transform duration-200 
                                            {{ $index === 0 ? 'scale-100' : 'scale-0' }}"
                                            id="radio-inner-{{ $option['id'] }}"
                                        ></div>
                                    </div>
                                </div>

                                <!-- Popular Badge -->
                                @if(isset($option['is_popular']) && $option['is_popular'])
                                    <span class="absolute top-4 left-6 md:left-8 bg-[#E35D25] text-white text-[9px] font-extrabold uppercase tracking-widest px-2.5 py-1 rounded-md shadow-sm">
                                        POPULER
                                    </span>
                                @endif

                                <!-- Package Details -->
                                <div class="{{ isset($option['is_popular']) && $option['is_popular'] ? 'mt-4' : '' }}">
                                    <div class="flex flex-col md:flex-row md:items-baseline justify-between pr-8">
                                        <h3 class="font-serif text-2xl font-bold text-[#1E1B19] leading-tight">
                                            {{ $option['name'] }}
                                        </h3>
                                        <div class="text-2xl font-semibold text-[#1E1B19] mt-2 md:mt-0 whitespace-nowrap">
                                            <span class="font-serif text-sm font-medium mr-1 text-[#1E1B19]/60">Rp</span>{{ explode('.', $option['price'])[0] }}<span class="text-xs text-[#1E1B19]/50 font-normal">.{{ explode('.', $option['price'])[1] ?? '000' }}</span>
                                        </div>
                                    </div>

                                    <p class="text-sm text-[#1E1B19]/60 mt-3 leading-relaxed pr-6 md:pr-12 border-b border-[#f3f3f3] pb-5">
                                        {{ $option['description'] }}
                                    </p>

                                    <!-- Features Grid -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3 mt-5">
                                        @foreach($option['features'] as $feature)
                                            <div class="flex items-center space-x-2 text-xs font-semibold text-[#1E1B19]/80">
                                                <span class="w-1.5 h-1.5 rounded-full bg-[#E35D25]"></span>
                                                <span>{{ $feature }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- RIGHT COLUMN: FORM -->
                <div class="lg:col-span-5">
                    <div class="bg-[#FAF5EE]/70 rounded-[32px] border border-[#f3eee7] p-8 md:p-10 shadow-sm sticky top-8">
                        <div class="mb-8">
                            <h3 class="font-serif text-2xl font-bold text-[#1E1B19]">{{ $service['form_title'] }}</h3>
                            <p class="text-xs font-semibold text-[#1E1B19]/60 mt-1.5">{{ $service['form_subtitle'] }}</p>
                        </div>

                        <!-- Validation Errors List -->
                        @if ($errors->any())
                            <div class="mb-6 p-4 bg-rose-50 border border-rose-100 rounded-2xl text-xs text-rose-800 space-y-1">
                                <p class="font-bold">Mohon perbaiki isian berikut:</p>
                                <ul class="list-disc pl-4 space-y-0.5 font-medium">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('layanan.store', $service['slug']) }}" method="POST" class="space-y-5" id="order-form">
                            @csrf
                            
                            <!-- Hidden Field for selected package -->
                            <input type="hidden" name="package_selected" id="package-input" value="{{ $service['options'][0]['name'] }}">

                            <!-- Package Selected Indicator Text in Form -->
                            <div class="bg-[#F1EBE2] border border-[#e6decb]/40 rounded-2xl p-4 flex items-center justify-between">
                                <div>
                                    <p class="text-[9px] font-extrabold uppercase tracking-widest text-[#1E1B19]/40 leading-none">Paket Dipilih</p>
                                    <p class="text-sm font-bold text-[#1E1B19] mt-1.5" id="selected-package-display">
                                        {{ $service['options'][0]['name'] }}
                                    </p>
                                </div>
                                <span class="bg-white text-[#E35D25] text-xs font-bold border border-[#e0d6c4] px-3.5 py-1.5 rounded-full shadow-sm whitespace-nowrap" id="selected-price-display">
                                    Rp {{ $service['options'][0]['price'] }}
                                </span>
                            </div>

                            @if($service['slug'] === 'network-analyst')
                                <!-- Network Analyst Fields (Matches image exactly) -->
                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Nama / Perusahaan</label>
                                    <input 
                                        type="text" 
                                        name="nama_perusahaan" 
                                        value="{{ old('nama_perusahaan', Auth::check() ? Auth::user()->name : '') }}" 
                                        placeholder="Nama atau perusahaan"
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                        required
                                    >
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">No. Whatsapp</label>
                                        <input 
                                            type="tel" 
                                            name="no_whatsapp" 
                                            value="{{ old('no_whatsapp', Auth::check() ? Auth::user()->whatsapp_number : '') }}" 
                                            placeholder="08xx-xxxx-xxxx"
                                            class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                            required
                                        >
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Email Kerja</label>
                                        <input 
                                            type="email" 
                                            name="email_kerja" 
                                            value="{{ old('email_kerja', Auth::check() ? Auth::user()->email : '') }}" 
                                            placeholder="nama@perusahaan.com"
                                            class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                            required
                                        >
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Jumlah Karyawan</label>
                                        <input 
                                            type="text" 
                                            name="jumlah_karyawan" 
                                            value="{{ old('jumlah_karyawan') }}" 
                                            placeholder="1-10"
                                            class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                        >
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Jumlah Lokasi</label>
                                        <input 
                                            type="text" 
                                            name="jumlah_lokasi" 
                                            value="{{ old('jumlah_lokasi') }}" 
                                            placeholder="1 lokasi"
                                            class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                        >
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Perangkat Utama Saat Ini</label>
                                    <input 
                                        type="text" 
                                        name="perangkat_utama" 
                                        value="{{ old('perangkat_utama') }}" 
                                        placeholder="Mikrotik"
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                    >
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Masalah Utama</label>
                                    <textarea 
                                        name="masalah_utama" 
                                        rows="3" 
                                        placeholder="Mis: koneksi sering putus, lambat di jam sibuk, sinyal tidak merata..."
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200 resize-none"
                                        required
                                    >{{ old('masalah_utama') }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Alamat Lokasi</label>
                                    <input 
                                        type="text" 
                                        name="alamat_lokasi" 
                                        value="{{ old('alamat_lokasi') }}" 
                                        placeholder="Alamat kantor"
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                        required
                                    >
                                </div>
                            
                            @else
                                <!-- Dynamic Generic Fields for other services -->
                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Nama Lengkap / Instansi</label>
                                    <input 
                                        type="text" 
                                        name="nama_perusahaan" 
                                        value="{{ old('nama_perusahaan', Auth::check() ? Auth::user()->name : '') }}" 
                                        placeholder="Ketik nama Anda"
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                        required
                                    >
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">No. Whatsapp</label>
                                        <input 
                                            type="tel" 
                                            name="no_whatsapp" 
                                            value="{{ old('no_whatsapp', Auth::check() ? Auth::user()->whatsapp_number : '') }}" 
                                            placeholder="08xx-xxxx-xxxx"
                                            class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                            required
                                        >
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Email</label>
                                        <input 
                                            type="email" 
                                            name="email_kerja" 
                                            value="{{ old('email_kerja', Auth::check() ? Auth::user()->email : '') }}" 
                                            placeholder="nama@email.com"
                                            class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                            required
                                        >
                                    </div>
                                </div>

                                @if($service['slug'] === 'pemasangan-wifi')
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Luas Bangunan (m²)</label>
                                            <input type="text" name="luas_bangunan" placeholder="e.g. 100" class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] transition-all duration-200">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Jumlah Lantai</label>
                                            <input type="text" name="jumlah_lantai" placeholder="e.g. 2" class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] transition-all duration-200">
                                        </div>
                                    </div>
                                @elseif($service['slug'] === 'rakit-pc')
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Budget Rakit PC (Rp)</label>
                                        <input type="text" name="budget" placeholder="e.g. 15.000.000" class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] transition-all duration-200">
                                    </div>
                                @elseif($service['slug'] === 'printing-cetak')
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Link File Desain (Drive/Dropbox)</label>
                                        <input type="url" name="link_desain" placeholder="https://drive.google.com/..." class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] transition-all duration-200">
                                    </div>
                                @endif

                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Detail Permintaan / Brief Kebutuhan</label>
                                    <textarea 
                                        name="masalah_utama" 
                                        rows="4" 
                                        placeholder="Ketik rincian spesifikasi, bahan cetak, brief desain, atau masalah yang dialami..."
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200 resize-none"
                                        required
                                    >{{ old('masalah_utama') }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Alamat / Lokasi Kirim</label>
                                    <input 
                                        type="text" 
                                        name="alamat_lokasi" 
                                        value="{{ old('alamat_lokasi') }}" 
                                        placeholder="Alamat lengkap"
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                    >
                                </div>
                            @endif

                            <button 
                                type="submit" 
                                class="w-full bg-[#1E1B19] hover:bg-[#E35D25] text-white text-sm font-bold uppercase tracking-wider py-4 px-6 rounded-full flex items-center justify-center space-x-2 transition-all duration-300 cursor-pointer shadow-md hover:shadow-lg mt-4 active:scale-[0.98]"
                            >
                                <span>{{ $service['submit_button_text'] }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>

                            <p class="text-[10px] text-center text-[#1E1B19]/50 mt-4 leading-relaxed font-semibold">
                                Konsultasi awal gratis — kami akan jadwalkan video call atau kunjungan singkat.
                            </p>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            // Store package options locally
            const serviceOptions = @json($service['options']);

            function selectPackage(packageName, packageId, index) {
                // Update hidden input
                document.getElementById('package-input').value = packageName;

                // Update text display inside form
                document.getElementById('selected-package-display').textContent = packageName;

                // Update price indicator inside form
                const option = serviceOptions[index];
                document.getElementById('selected-price-display').textContent = 'Rp ' + option.price;

                // Update styling of all cards
                document.querySelectorAll('.package-card').forEach(card => {
                    card.classList.remove('border-[#E35D25]', 'shadow-sm');
                    card.classList.add('border-[#eee]');
                });

                // Highlight selected card
                const selectedCard = document.getElementById('card-' + packageId);
                selectedCard.classList.remove('border-[#eee]');
                selectedCard.classList.add('border-[#E35D25]', 'shadow-sm');

                // Update radio circles
                document.querySelectorAll('[id^="radio-outer-"]').forEach(outer => {
                    outer.classList.remove('border-[#E35D25]');
                    outer.classList.add('border-[#ccc]');
                });
                document.querySelectorAll('[id^="radio-inner-"]').forEach(inner => {
                    inner.classList.remove('scale-100');
                    inner.classList.add('scale-0');
                });

                // Show selected radio circle
                document.getElementById('radio-outer-' + packageId).classList.remove('border-[#ccc]');
                document.getElementById('radio-outer-' + packageId).classList.add('border-[#E35D25]');
                document.getElementById('radio-inner-' + packageId).classList.remove('scale-0');
                document.getElementById('radio-inner-' + packageId).classList.add('scale-100');
            }
        </script>
    @endpush
</x-layouts.app>
