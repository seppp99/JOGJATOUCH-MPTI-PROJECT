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

            @if($service['slug'] === 'printing-cetak')
            {{-- ─────────────────────────────────────────────────────────── --}}
            {{-- PRINTING-CETAK CUSTOM LAYOUT                                --}}
            {{-- ─────────────────────────────────────────────────────────── --}}

            {{-- 1. Section heading --}}
            <div class="mb-8">
                <h2 class="font-serif-display text-3xl font-semibold text-[#1E1B19]">Pilih jenis cetak</h2>
            </div>

            {{-- 2. Product carousel --}}
            <div class="relative mb-2">
                <button onclick="printCarouselPrev()" class="absolute -left-2 md:left-0 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-white border border-[#1E1B19]/10 flex items-center justify-center shadow-md hover:bg-[#FBF9F6] transition-colors">
                    <svg class="w-4 h-4 text-[#1E1B19]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>

                <div class="mx-8 md:mx-12 overflow-hidden">
                    <div class="flex gap-4 transition-all duration-500" id="print-carousel-track" style="align-items:stretch;">
                        @foreach($service['options'] as $i => $opt)
                        <div
                            class="print-product-card flex-shrink-0 flex flex-col rounded-3xl border-2 cursor-pointer transition-all duration-500 overflow-hidden select-none bg-white"
                            data-index="{{ $i }}"
                            onclick="setPrintActive({{ $i }})"
                            style="width:calc(33.333% - 11px);"
                        >
                            <div class="p-7 md:p-10 relative">
                                @if(isset($opt['is_popular']) && $opt['is_popular'])
                                <span class="absolute top-7 right-7 bg-[#E35D25] text-white text-[10px] font-extrabold uppercase tracking-widest px-3 py-1.5 rounded-md">POPULER</span>
                                @endif
                                <p class="text-xs font-bold tracking-widest uppercase text-[#1E1B19]/40 mb-3">{{ $opt['category_sub'] ?? '' }}</p>
                                <h3 class="font-serif-display text-3xl md:text-4xl font-bold text-[#1E1B19] mb-4 leading-tight pr-20">{{ $opt['name'] }}</h3>
                                <p class="text-sm text-[#1E1B19]/55 leading-relaxed mb-6 line-clamp-3">{{ $opt['description'] }}</p>
                                <div class="grid grid-cols-2 gap-x-4 gap-y-3 mb-6">
                                    @foreach($opt['features'] as $feat)
                                    <div class="flex items-center gap-2 text-sm font-semibold text-[#1E1B19]/70">
                                        <span class="w-2 h-2 rounded-full bg-[#E35D25] shrink-0"></span>
                                        <span class="leading-tight">{{ $feat }}</span>
                                    </div>
                                    @endforeach
                                </div>
                                <span class="text-sm font-bold text-[#E35D25]">Pilih layanan &rarr;</span>
                            </div>
                            <div class="mx-6 mb-6 rounded-2xl border-2 border-dashed border-[#1E1B19]/10 bg-[#FBF9F6] h-44 flex flex-col items-center justify-center gap-2">
                                <svg class="w-10 h-10 text-[#1E1B19]/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span class="text-xs text-[#1E1B19]/30 font-medium text-center px-4">Letakkan foto contoh {{ $opt['name'] }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <button onclick="printCarouselNext()" class="absolute -right-2 md:right-0 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-white border border-[#1E1B19]/10 flex items-center justify-center shadow-md hover:bg-[#FBF9F6] transition-colors">
                    <svg class="w-4 h-4 text-[#1E1B19]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            {{-- Navigation hint --}}
            <div class="flex items-center justify-center gap-3 mb-10">
                <span class="text-[#1E1B19]/25 text-xs">&larr;</span>
                <span class="text-[10px] text-[#1E1B19]/40 font-medium tracking-wide">geser kartu untuk lihat semua produk</span>
                <span class="text-[#1E1B19]/25 text-xs">&rarr;</span>
            </div>

            {{-- 3. Preview Box --}}
            <div class="rounded-3xl border-2 border-dashed border-[#1E1B19]/10 bg-[#F9F6F2] p-8 md:p-12 flex flex-col items-center justify-center min-h-[200px] mb-10">
                <div class="inline-flex items-center gap-2 bg-[#1E1B19] text-white text-xs font-bold px-4 py-2 rounded-full mb-5">
                    Preview &bull; <span id="print-preview-product">{{ $service['options'][0]['name'] }}</span>
                </div>
                <div class="w-14 h-14 rounded-2xl border-2 border-dashed border-[#1E1B19]/15 bg-white flex items-center justify-center mb-3">
                    <svg class="w-6 h-6 text-[#1E1B19]/25" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-xs text-[#1E1B19]/35 font-medium" id="print-preview-sub">Letakkan foto contoh {{ $service['options'][0]['name'] }} (opsional)</p>
            </div>

            {{-- 4. Product Detail sections (show/hide per active product) --}}
            @foreach($service['options'] as $i => $opt)
            <div class="print-detail-section {{ $i > 0 ? 'hidden' : '' }}" data-index="{{ $i }}">
                <p class="text-xs font-bold tracking-widest uppercase text-[#E35D25] mb-3">✦ {{ $opt['category_sub'] ?? '' }}</p>
                <h2 class="font-serif-display text-4xl md:text-5xl font-bold text-[#1E1B19] mb-4 leading-tight">{{ $opt['name'] }}</h2>
                <p class="text-[#1E1B19]/60 text-base leading-relaxed mb-6 max-w-2xl">{{ $opt['description'] }}</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-8">
                    @foreach($opt['features'] as $feat)
                    <div class="flex items-center gap-2 text-sm font-semibold text-[#1E1B19]/80">
                        <svg class="w-4 h-4 text-[#E35D25] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ $feat }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach

            {{-- 5. Scroll-to-form CTA --}}
            <div class="mb-10">
                <button onclick="document.getElementById('print-form-section').scrollIntoView({behavior:'smooth'})"
                    class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-[#1E1B19] text-white text-sm font-bold hover:bg-[#E35D25] transition-colors duration-300">
                    <span>Isi formulir pesanan</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                </button>
            </div>

            {{-- 6. Form Section --}}
            <div id="print-form-section" class="scroll-mt-24">
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-grow border-t border-[#1E1B19]/10"></div>
                    <span class="text-[10px] font-bold tracking-widest uppercase text-[#1E1B19]/40">✦ Formulir Pemesanan</span>
                    <div class="flex-grow border-t border-[#1E1B19]/10"></div>
                </div>
                <h2 class="font-serif-display text-4xl md:text-5xl font-bold text-[#1E1B19] mb-8 leading-tight">
                    Atur &amp; <span class="text-[#E35D25] italic font-serif">pesan</span> cetakanmu
                </h2>

                @if ($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border border-rose-100 rounded-2xl text-xs text-rose-800 space-y-1 max-w-2xl">
                    <p class="font-bold">Mohon perbaiki isian berikut:</p>
                    <ul class="list-disc pl-4 space-y-0.5 font-medium">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
                @endif

                @php
                $inputCls = 'w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all';
                $selectCls = 'w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all';
                $labelCls = 'block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2';
                $qtyBtnCls = 'w-9 h-9 rounded-lg border border-[#e8dfd3] bg-white flex items-center justify-center text-[#1E1B19] hover:border-[#E35D25] transition-colors font-bold text-lg leading-none';
                $userName = session()->has('user') ? session('user.name') : '';
                $userWa = session()->has('user') ? session('user.whatsapp') : '';
                @endphp

                {{-- FORM: BUKU CUSTOM --}}
                <div class="print-form-panel" data-index="0">
                    <div class="bg-[#FAF5EE]/70 rounded-[32px] border border-[#f3eee7] p-6 md:p-8 shadow-sm max-w-2xl mx-auto">
                        <div class="mb-5"><h3 class="font-serif text-2xl font-bold text-[#1E1B19]">Pesan Buku Custom</h3><p class="text-xs font-semibold text-[#1E1B19]/60 mt-1">Cetak buku dan file desainmu — atur ukuran, cover, dan jilid.</p></div>
                        <form action="{{ route('layanan.store', 'printing-cetak') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="package_selected" value="Buku Custom">
                            <input type="hidden" name="email_kerja" value="{{ $userWa ?: 'info@jogjatouch.com' }}">
                            <div><label class="{{ $labelCls }}">Nama / Brand</label><input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $userName) }}" placeholder="Nama Anda" class="{{ $inputCls }}" required></div>
                            <div class="grid grid-cols-2 gap-4">
                                <div><label class="{{ $labelCls }}">No. WhatsApp</label><input type="tel" name="no_whatsapp" value="{{ old('no_whatsapp', $userWa) }}" placeholder="08xx-xxxx-xxxx" class="{{ $inputCls }}" required></div>
                                <div><label class="{{ $labelCls }}">Jumlah</label>
                                    <div class="flex items-center gap-2">
                                        <button type="button" onclick="this.nextElementSibling.stepDown()" class="{{ $qtyBtnCls }}">−</button>
                                        <input type="number" name="jumlah" min="1" value="1" class="flex-1 bg-white border border-[#e8dfd3] rounded-xl px-3 py-3.5 text-sm font-bold text-center focus:outline-none focus:border-[#E35D25] transition-all">
                                        <button type="button" onclick="this.previousElementSibling.stepUp()" class="{{ $qtyBtnCls }}">+</button>
                                    </div>
                                </div>
                            </div>
                            <div><label class="{{ $labelCls }}">Ukuran</label>
                                <select name="ukuran" class="{{ $selectCls }}"><option>A4 - 21 × 29.7 cm</option><option>B5 - 18.2 × 25.7 cm</option><option>A5 - 14.8 × 21 cm</option></select>
                            </div>
                            <div><label class="{{ $labelCls }}">Jenis Cover</label>
                                <select name="jenis_cover" class="{{ $selectCls }}"><option>Softcover art carton 260gsm</option><option>Hardcover laminasi doff</option><option>Hardcover laminasi glossy</option></select>
                            </div>
                            <div><label class="{{ $labelCls }}">Penjilidan</label>
                                <select name="penjilidan" class="{{ $selectCls }}"><option>Lem panas / perfect bind</option><option>Jahit benang</option><option>Spiral</option><option>Staples saddle stitch</option></select>
                            </div>
                            <div><label class="{{ $labelCls }}">Jumlah Halaman</label>
                                <select name="jumlah_halaman" class="{{ $selectCls }}"><option>s/d 40 halaman</option><option>41–80 halaman</option><option>81–120 halaman</option><option>121–200 halaman</option><option>&gt; 200 halaman</option></select>
                            </div>
                            <div><label class="{{ $labelCls }}">Catatan / Detail Tambahan</label>
                                <textarea name="masalah_utama" rows="3" placeholder="Deadline, warna dominan, permintaan khusus..." class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all resize-none" required>{{ old('masalah_utama') }}</textarea>
                            </div>
                            <button type="submit" class="w-full bg-[#1E1B19] hover:bg-[#E35D25] text-white text-sm font-bold uppercase tracking-wider py-4 px-6 rounded-full flex items-center justify-center gap-2 transition-all duration-300 shadow-md active:scale-[0.98]">
                                <span>Pesan Cetakan</span><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                            <p class="text-[10px] text-center text-[#1E1B19]/50 font-semibold leading-relaxed">Tim JogjaTouch konfirmasi total final &amp; link upload via WhatsApp</p>
                        </form>
                    </div>
                </div>

                {{-- FORM: PHOTOBOOK --}}
                <div class="print-form-panel hidden" data-index="1">
                    <div class="bg-[#FAF5EE]/70 rounded-[32px] border border-[#f3eee7] p-6 md:p-8 shadow-sm max-w-2xl mx-auto">
                        <div class="mb-5"><h3 class="font-serif text-2xl font-bold text-[#1E1B19]">Pesan Photobook</h3><p class="text-xs font-semibold text-[#1E1B19]/60 mt-1">Album hardcover A4 — cukup kirim folder fotonya, layout dibantu tim.</p></div>
                        <form action="{{ route('layanan.store', 'printing-cetak') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="package_selected" value="Photobook">
                            <input type="hidden" name="email_kerja" value="{{ $userWa ?: 'info@jogjatouch.com' }}">
                            <div><label class="{{ $labelCls }}">Nama / Brand</label><input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $userName) }}" placeholder="Nama Anda" class="{{ $inputCls }}" required></div>
                            <div class="grid grid-cols-2 gap-4">
                                <div><label class="{{ $labelCls }}">No. WhatsApp</label><input type="tel" name="no_whatsapp" value="{{ old('no_whatsapp', $userWa) }}" placeholder="08xx-xxxx-xxxx" class="{{ $inputCls }}" required></div>
                                <div><label class="{{ $labelCls }}">Jumlah</label>
                                    <div class="flex items-center gap-2">
                                        <button type="button" onclick="this.nextElementSibling.stepDown()" class="{{ $qtyBtnCls }}">−</button>
                                        <input type="number" name="jumlah" min="1" value="1" class="flex-1 bg-white border border-[#e8dfd3] rounded-xl px-3 py-3.5 text-sm font-bold text-center focus:outline-none focus:border-[#E35D25] transition-all">
                                        <button type="button" onclick="this.previousElementSibling.stepUp()" class="{{ $qtyBtnCls }}">+</button>
                                    </div>
                                </div>
                            </div>
                            <div><label class="{{ $labelCls }}">Ukuran</label>
                                <select name="ukuran" class="{{ $selectCls }}"><option>A4 landscape - 29.7 × 21 cm</option><option>A4 portrait - 21 × 29.7 cm</option><option>Square 20 × 20 cm</option></select>
                            </div>
                            <div><label class="{{ $labelCls }}">Cover</label>
                                <select name="cover" class="{{ $selectCls }}"><option>Hardcover laminasi doff</option><option>Hardcover laminasi glossy</option><option>Leather cover premium</option></select>
                            </div>
                            <div><label class="{{ $labelCls }}">Kertas Isi</label>
                                <select name="kertas_isi" class="{{ $selectCls }}"><option>Art paper 110gsm</option><option>Art paper 150gsm</option><option>Glossy photo paper</option></select>
                            </div>
                            <div><label class="{{ $labelCls }}">Jumlah Halaman</label>
                                <select name="jumlah_halaman" class="{{ $selectCls }}"><option>20 halaman / 10 spread</option><option>28 halaman / 14 spread</option><option>36 halaman / 18 spread</option><option>40 halaman / 20 spread</option></select>
                            </div>
                            <div>
                                <label class="{{ $labelCls }}">☁ Link folder foto (Google Drive / Canva) <span class="text-[#E35D25]">?</span></label>
                                <p class="text-[10px] text-[#1E1B19]/50 mb-2 leading-relaxed">Kumpulkan semua foto dalam satu folder, lalu tempel linknya. Set akses ke "siapa saja yang memiliki link".</p>
                                <div class="flex gap-2 mb-2">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-[#1E1B19]/5 text-[#1E1B19]/60 cursor-pointer hover:bg-[#E35D25]/10 hover:text-[#E35D25] transition-colors">Google Drive</span>
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-[#1E1B19]/5 text-[#1E1B19]/60 cursor-pointer hover:bg-[#E35D25]/10 hover:text-[#E35D25] transition-colors">Canva</span>
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-[#1E1B19]/5 text-[#1E1B19]/60 cursor-pointer hover:bg-[#E35D25]/10 hover:text-[#E35D25] transition-colors">Dropbox</span>
                                </div>
                                <input type="url" name="link_folder_foto" placeholder="https://drive.google.com/... atau https://canva.com/..." class="{{ $inputCls }}">
                            </div>
                            <div><label class="{{ $labelCls }}">Catatan / Detail Tambahan</label>
                                <textarea name="masalah_utama" rows="3" placeholder="Deadline, warna dominan, permintaan khusus..." class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all resize-none" required>{{ old('masalah_utama') }}</textarea>
                            </div>
                            <button type="submit" class="w-full bg-[#1E1B19] hover:bg-[#E35D25] text-white text-sm font-bold uppercase tracking-wider py-4 px-6 rounded-full flex items-center justify-center gap-2 transition-all duration-300 shadow-md active:scale-[0.98]">
                                <span>Pesan Cetakan</span><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                            <p class="text-[10px] text-center text-[#1E1B19]/50 font-semibold leading-relaxed">Tim JogjaTouch konfirmasi total final &amp; link upload via WhatsApp</p>
                        </form>
                    </div>
                </div>

                {{-- FORM: CETAK FOTO --}}
                <div class="print-form-panel hidden" data-index="2">
                    <div class="bg-[#FAF5EE]/70 rounded-[32px] border border-[#f3eee7] p-6 md:p-8 shadow-sm max-w-2xl mx-auto">
                        <div class="mb-5"><h3 class="font-serif text-2xl font-bold text-[#1E1B19]">Pesan Cetak Foto</h3><p class="text-xs font-semibold text-[#1E1B19]/60 mt-1">Cetak foto satuan dari 4R sampai poster raksasa A0.</p></div>
                        <form action="{{ route('layanan.store', 'printing-cetak') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="package_selected" value="Cetak Foto">
                            <input type="hidden" name="email_kerja" value="{{ $userWa ?: 'info@jogjatouch.com' }}">
                            <div><label class="{{ $labelCls }}">Nama / Brand</label><input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $userName) }}" placeholder="Nama Anda" class="{{ $inputCls }}" required></div>
                            <div class="grid grid-cols-2 gap-4">
                                <div><label class="{{ $labelCls }}">No. WhatsApp</label><input type="tel" name="no_whatsapp" value="{{ old('no_whatsapp', $userWa) }}" placeholder="08xx-xxxx-xxxx" class="{{ $inputCls }}" required></div>
                                <div><label class="{{ $labelCls }}">Jumlah</label>
                                    <div class="flex items-center gap-2">
                                        <button type="button" onclick="this.nextElementSibling.stepDown()" class="{{ $qtyBtnCls }}">−</button>
                                        <input type="number" name="jumlah" min="1" value="1" class="flex-1 bg-white border border-[#e8dfd3] rounded-xl px-3 py-3.5 text-sm font-bold text-center focus:outline-none focus:border-[#E35D25] transition-all">
                                        <button type="button" onclick="this.previousElementSibling.stepUp()" class="{{ $qtyBtnCls }}">+</button>
                                    </div>
                                </div>
                            </div>
                            <div><label class="{{ $labelCls }}">Ukuran Cetak</label>
                                <select name="ukuran_cetak" class="{{ $selectCls }}"><option>4R - 10 × 15 cm</option><option>5R - 12.7 × 17.8 cm</option><option>6R - 15 × 20 cm</option><option>8R - 20 × 25 cm</option><option>A4 - 21 × 29.7 cm</option><option>A3 - 29.7 × 42 cm</option><option>A2 - 42 × 59.4 cm</option><option>A1 - 59.4 × 84.1 cm</option><option>A0 - 84.1 × 118.9 cm</option></select>
                            </div>
                            <div><label class="{{ $labelCls }}">Finishing Kertas</label>
                                <select name="finishing_kertas" class="{{ $selectCls }}"><option>Glossy</option><option>Matte / Doff</option><option>Luster / Semi-gloss</option></select>
                            </div>
                            <div><label class="{{ $labelCls }}">Laminasi</label>
                                <select name="laminasi" class="{{ $selectCls }}"><option>Tanpa laminasi</option><option>Laminasi glossy</option><option>Laminasi doff</option></select>
                            </div>
                            <div><label class="{{ $labelCls }}">Catatan / Detail Tambahan</label>
                                <textarea name="masalah_utama" rows="3" placeholder="Deadline, warna dominan, permintaan khusus..." class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all resize-none" required>{{ old('masalah_utama') }}</textarea>
                            </div>
                            <button type="submit" class="w-full bg-[#1E1B19] hover:bg-[#E35D25] text-white text-sm font-bold uppercase tracking-wider py-4 px-6 rounded-full flex items-center justify-center gap-2 transition-all duration-300 shadow-md active:scale-[0.98]">
                                <span>Pesan Cetakan</span><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                            <p class="text-[10px] text-center text-[#1E1B19]/50 font-semibold leading-relaxed">Tim JogjaTouch konfirmasi total final &amp; link upload via WhatsApp</p>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Confirmation Overlay --}}
            <div id="print-confirm-overlay" class="fixed inset-0 bg-[#1E1B19]/70 z-50 flex items-center justify-center hidden backdrop-blur-sm px-4">
                <div class="bg-[#FBF9F6] rounded-[32px] w-full max-w-md shadow-2xl overflow-hidden">
                    {{-- Header --}}
                    <div class="bg-[#1E1B19] px-8 py-6">
                        <p class="text-[9px] font-bold tracking-widest uppercase text-white/40 mb-1">✦ Konfirmasi Pesanan</p>
                        <h3 class="font-serif-display text-2xl font-bold text-white" id="print-confirm-product">Buku Custom</h3>
                    </div>
                    {{-- Body --}}
                    <div class="px-8 py-6 max-h-[55vh] overflow-y-auto">
                        <div id="print-confirm-body" class="divide-y divide-[#1E1B19]/5"></div>
                    </div>
                    {{-- Actions --}}
                    <div class="px-8 pb-8 pt-4 flex flex-col gap-3">
                        <button onclick="submitPrintForm()" class="w-full bg-[#E35D25] hover:bg-[#c74c1a] text-white text-sm font-bold uppercase tracking-wider py-4 px-6 rounded-full flex items-center justify-center gap-2 transition-all duration-300 shadow-md active:scale-[0.98]">
                            <span>Pesan Sekarang via WhatsApp</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                        <button onclick="closePrintConfirm()" class="w-full border border-[#1E1B19]/15 bg-white hover:bg-[#f0ebe4] text-[#1E1B19] text-sm font-semibold py-3.5 px-6 rounded-full flex items-center justify-center gap-2 transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            <span>Ubah Pesanan</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- END PRINTING LAYOUT --}}

            @else
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

                                                @if($service['slug'] === 'pemasangan-wifi')
                        <form action="{{ route('layanan.wifi.order') }}" method="POST" class="space-y-5" id="order-form">
                            @csrf
                            
                            <!-- Hidden Field for selected package -->
                            <input type="hidden" name="paket_dipilih" id="package-input" value="{{ $service['options'][0]['name'] }}">

                            <!-- Package Selected Indicator Text in Form -->
                            <div class="bg-[#F1EBE2] border border-[#e6decb]/40 rounded-2xl p-4 flex items-center justify-between">
                                <div>
                                    <p class="text-[9px] font-extrabold uppercase tracking-widest text-[#1E1B19]/40 leading-none">Layanan Dipilih</p>
                                    <p class="text-sm font-bold text-[#1E1B19] mt-1.5" id="selected-package-display">
                                        {{ $service['options'][0]['name'] }}
                                    </p>
                                </div>
                                <span class="bg-[#E35D25] text-white text-xs font-bold px-3.5 py-1.5 rounded-full shadow-sm whitespace-nowrap">
                                    Konsultasi Gratis
                                </span>
                            </div>

                            <div>
                                <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Nama Pelanggan</label>
                                <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan', Auth::check() ? Auth::user()->name : '') }}" placeholder="Nama Anda" class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200" required>
                                @error('nama_pelanggan')<p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>@enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">No. Whatsapp</label>
                                    <input type="tel" name="whatsapp_number" value="{{ old('whatsapp_number', Auth::check() ? Auth::user()->whatsapp_number : '') }}" placeholder="08xx-xxxx-xxxx" class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200" required>
                                    @error('whatsapp_number')<p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Email</label>
                                    <input type="email" name="email" value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}" placeholder="nama@email.com" class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200" required>
                                    @error('email')<p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Luas Bangunan (m�)</label>
                                    <input type="text" name="luas_bangunan" value="{{ old('luas_bangunan') }}" placeholder="e.g. 100" class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200">
                                    @error('luas_bangunan')<p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Jumlah Lantai</label>
                                    <input type="text" name="jumlah_lantai" value="{{ old('jumlah_lantai') }}" placeholder="e.g. 2" class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200">
                                    @error('jumlah_lantai')<p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Detail Kebutuhan</label>
                                <textarea name="detail_kebutuhan" rows="4" placeholder="Ketik detail spesifikasi atau kendala yang dialami..." class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200 resize-none" required>{{ old('detail_kebutuhan') }}</textarea>
                                @error('detail_kebutuhan')<p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Alamat Lokasi</label>
                                <input type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Alamat lengkap lokasi pemasangan" class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200" required>
                                @error('alamat')<p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>@enderror
                            </div>

                            <button type="submit" class="w-full bg-[#1E1B19] hover:bg-[#E35D25] text-white text-sm font-bold uppercase tracking-wider py-4 px-6 rounded-full flex items-center justify-center gap-2 transition-all duration-300 shadow-md active:scale-[0.98] mt-4">
                                <span>{{ $service['submit_button_text'] }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </form>
                        @elseif($service['slug'] === 'network-analyst')
                            <!-- Network Analyst Fields -->
                            <form action="{{ route('layanan.network.order') }}" method="POST" class="space-y-5" id="order-form">
                                @csrf
                                
                                <!-- Hidden Field for selected package -->
                                <input type="hidden" name="paket_dipilih" id="package-input" value="{{ $service['options'][0]['name'] }}">

                                <!-- Package Selected Indicator Text in Form -->
                                <div class="bg-[#F1EBE2] border border-[#e6decb]/40 rounded-2xl p-4 flex items-center justify-between">
                                    <div>
                                        <p class="text-[9px] font-extrabold uppercase tracking-widest text-[#1E1B19]/40 leading-none">Layanan Dipilih</p>
                                        <p class="text-sm font-bold text-[#1E1B19] mt-1.5" id="selected-package-display">
                                            {{ $service['options'][0]['name'] }}
                                        </p>
                                    </div>
                                    <span class="bg-[#E35D25] text-white text-xs font-bold px-3.5 py-1.5 rounded-full shadow-sm whitespace-nowrap">
                                        Konsultasi Gratis
                                    </span>
                                </div>
                                
                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Nama / Perusahaan</label>
                                    <input 
                                        type="text" 
                                        name="nama_pelanggan" 
                                        value="{{ old('nama_pelanggan', auth()->check() ? auth()->user()->name : '') }}" 
                                        placeholder="Nama atau perusahaan"
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                        required
                                    >
                                    @error('nama_pelanggan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">No. Whatsapp</label>
                                        <input 
                                            type="tel" 
                                            name="whatsapp_number" 
                                            value="{{ old('whatsapp_number', auth()->check() ? auth()->user()->whatsapp_number : '') }}" 
                                            placeholder="08xx-xxxx-xxxx"
                                            class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                            required
                                        >
                                        @error('whatsapp_number')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Email Kerja</label>
                                        <input 
                                            type="email" 
                                            name="email" 
                                            value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" 
                                            placeholder="nama@perusahaan.com"
                                            class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                            required
                                        >
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Jumlah Karyawan</label>
                                        <input 
                                            type="number" 
                                            name="jumlah_karyawan" 
                                            value="{{ old('jumlah_karyawan') }}" 
                                            placeholder="1-10"
                                            class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                        >
                                        @error('jumlah_karyawan')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Jumlah Lokasi</label>
                                        <input 
                                            type="number" 
                                            name="jumlah_lokasi" 
                                            value="{{ old('jumlah_lokasi') }}" 
                                            placeholder="1"
                                            class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                        >
                                        @error('jumlah_lokasi')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
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
                                    @error('perangkat_utama')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Masalah Utama</label>
                                    <textarea 
                                        name="detail_kebutuhan" 
                                        rows="3" 
                                        placeholder="Mis: koneksi sering putus, lambat di jam sibuk, sinyal tidak merata..."
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200 resize-none"
                                        required
                                    >{{ old('detail_kebutuhan') }}</textarea>
                                    @error('detail_kebutuhan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Alamat Lokasi</label>
                                    <input 
                                        type="text" 
                                        name="alamat" 
                                        value="{{ old('alamat') }}" 
                                        placeholder="Alamat kantor"
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                        required
                                    >
                                    @error('alamat')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                @if(session('error'))
                                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <button type="submit" class="w-full bg-[#E35D25] hover:bg-[#E35D25]/90 text-white font-bold py-4 px-8 rounded-xl transition-all duration-200 shadow-[0_4px_20px_-4px_rgba(227,93,37,0.4)] hover:shadow-[0_8px_25px_-5px_rgba(227,93,37,0.5)] hover:-translate-y-0.5 flex items-center justify-center group">
                                    <span>{{ $service['submit_button_text'] }}</span>
                                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </button>
                                <p class="text-[10px] font-semibold text-center text-[#1E1B19]/40 mt-4">
                                    Konsultasi awal gratis. Tim kami akan menghubungi Anda via WhatsApp.
                                </p>
                            </form>
                        @elseif($service['slug'] === 'perawatan-rutin')
                            <!-- Perawatan Rutin Fields -->
                            <form action="{{ route('layanan.perawatan.order') }}" method="POST" class="space-y-5" id="order-form">
                                @csrf
                                
                                <!-- Hidden Field for selected package -->
                                <input type="hidden" name="paket_dipilih" id="package-input" value="{{ $service['options'][0]['name'] }}">

                                <!-- Package Selected Indicator Text in Form -->
                                <div class="bg-[#F1EBE2] border border-[#e6decb]/40 rounded-2xl p-4 flex items-center justify-between">
                                    <div>
                                        <p class="text-[9px] font-extrabold uppercase tracking-widest text-[#1E1B19]/40 leading-none">Layanan Dipilih</p>
                                        <p class="text-sm font-bold text-[#1E1B19] mt-1.5" id="selected-package-display">
                                            {{ $service['options'][0]['name'] }}
                                        </p>
                                    </div>
                                    <span class="bg-[#E35D25] text-white text-xs font-bold px-3.5 py-1.5 rounded-full shadow-sm whitespace-nowrap">
                                        Konsultasi Gratis
                                    </span>
                                </div>
                                
                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Nama Pelanggan</label>
                                    <input 
                                        type="text" 
                                        name="nama_pelanggan" 
                                        value="{{ old('nama_pelanggan', auth()->check() ? auth()->user()->name : '') }}" 
                                        placeholder="Nama atau instansi"
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                        required
                                    >
                                    @error('nama_pelanggan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">No. Whatsapp</label>
                                        <input 
                                            type="tel" 
                                            name="whatsapp_number" 
                                            value="{{ old('whatsapp_number', auth()->check() ? auth()->user()->whatsapp_number : '') }}" 
                                            placeholder="08xx-xxxx-xxxx"
                                            class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                            required
                                        >
                                        @error('whatsapp_number')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Email</label>
                                        <input 
                                            type="email" 
                                            name="email" 
                                            value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" 
                                            placeholder="nama@email.com"
                                            class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                            required
                                        >
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Detail Kebutuhan</label>
                                    <textarea 
                                        name="detail_kebutuhan" 
                                        rows="3" 
                                        placeholder="Tuliskan spesifikasi, keluhan, atau layanan spesifik yang dibutuhkan..."
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200 resize-none"
                                        required
                                    >{{ old('detail_kebutuhan') }}</textarea>
                                    @error('detail_kebutuhan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Alamat Lokasi</label>
                                    <input 
                                        type="text" 
                                        name="alamat" 
                                        value="{{ old('alamat') }}" 
                                        placeholder="Alamat kantor atau lokasi maintenance"
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                        required
                                    >
                                    @error('alamat')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                @if(session('error'))
                                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <button type="submit" class="w-full bg-[#E35D25] hover:bg-[#E35D25]/90 text-white font-bold py-4 px-8 rounded-xl transition-all duration-200 shadow-[0_4px_20px_-4px_rgba(227,93,37,0.4)] hover:shadow-[0_8px_25px_-5px_rgba(227,93,37,0.5)] hover:-translate-y-0.5 flex items-center justify-center group">
                                    <span>{{ $service['submit_button_text'] }}</span>
                                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </button>
                                <p class="text-[10px] font-semibold text-center text-[#1E1B19]/40 mt-4">
                                    Konsultasi awal gratis. Tim kami akan menghubungi Anda via WhatsApp.
                                </p>
                            </form>
                        @elseif($service['slug'] === 'desain-grafis')
                            <!-- Desain Grafis Fields -->
                            <form action="{{ route('layanan.desain.order') }}" method="POST" class="space-y-5" id="order-form">
                                @csrf
                                
                                <!-- Hidden Field for selected package -->
                                <input type="hidden" name="paket_dipilih" id="package-input" value="{{ $service['options'][0]['name'] }}">

                                <!-- Package Selected Indicator Text in Form -->
                                <div class="bg-[#F1EBE2] border border-[#e6decb]/40 rounded-2xl p-4 flex items-center justify-between">
                                    <div>
                                        <p class="text-[9px] font-extrabold uppercase tracking-widest text-[#1E1B19]/40 leading-none">Layanan Dipilih</p>
                                        <p class="text-sm font-bold text-[#1E1B19] mt-1.5" id="selected-package-display">
                                            {{ $service['options'][0]['name'] }}
                                        </p>
                                    </div>
                                    <span class="bg-[#E35D25] text-white text-xs font-bold px-3.5 py-1.5 rounded-full shadow-sm whitespace-nowrap">
                                        Konsultasi Gratis
                                    </span>
                                </div>
                                
                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Nama Pelanggan</label>
                                    <input 
                                        type="text" 
                                        name="nama_pelanggan" 
                                        value="{{ old('nama_pelanggan', auth()->check() ? auth()->user()->name : '') }}" 
                                        placeholder="Nama atau instansi"
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                        required
                                    >
                                    @error('nama_pelanggan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">No. Whatsapp</label>
                                        <input 
                                            type="tel" 
                                            name="whatsapp_number" 
                                            value="{{ old('whatsapp_number', auth()->check() ? auth()->user()->whatsapp_number : '') }}" 
                                            placeholder="08xx-xxxx-xxxx"
                                            class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                            required
                                        >
                                        @error('whatsapp_number')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Email</label>
                                        <input 
                                            type="email" 
                                            name="email" 
                                            value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" 
                                            placeholder="nama@email.com"
                                            class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                            required
                                        >
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Detail Kebutuhan</label>
                                    <textarea 
                                        name="detail_kebutuhan" 
                                        rows="3" 
                                        placeholder="Tuliskan spesifikasi, keluhan, atau layanan spesifik yang dibutuhkan..."
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200 resize-none"
                                        required
                                    >{{ old('detail_kebutuhan') }}</textarea>
                                    @error('detail_kebutuhan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Alamat Lokasi</label>
                                    <input 
                                        type="text" 
                                        name="alamat" 
                                        value="{{ old('alamat') }}" 
                                        placeholder="Alamat kantor atau lokasi design"
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                        required
                                    >
                                    @error('alamat')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                @if(session('error'))
                                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <button type="submit" class="w-full bg-[#E35D25] hover:bg-[#E35D25]/90 text-white font-bold py-4 px-8 rounded-xl transition-all duration-200 shadow-[0_4px_20px_-4px_rgba(227,93,37,0.4)] hover:shadow-[0_8px_25px_-5px_rgba(227,93,37,0.5)] hover:-translate-y-0.5 flex items-center justify-center group">
                                    <span>{{ $service['submit_button_text'] }}</span>
                                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </button>
                                <p class="text-[10px] font-semibold text-center text-[#1E1B19]/40 mt-4">
                                    Konsultasi awal gratis. Tim kami akan menghubungi Anda via WhatsApp.
                                </p>
                            </form>
                        @elseif($service['slug'] === 'rakit-pc')
                            <!-- Rakit PC Fields -->
                            <form action="{{ route('layanan.rakit.order') }}" method="POST" class="space-y-5" id="order-form">
                                @csrf
                                
                                <!-- Hidden Field for selected package -->
                                <input type="hidden" name="paket_dipilih" id="package-input" value="{{ $service['options'][0]['name'] }}">

                                <!-- Package Selected Indicator Text in Form -->
                                <div class="bg-[#F1EBE2] border border-[#e6decb]/40 rounded-2xl p-4 flex items-center justify-between">
                                    <div>
                                        <p class="text-[9px] font-extrabold uppercase tracking-widest text-[#1E1B19]/40 leading-none">Layanan Dipilih</p>
                                        <p class="text-sm font-bold text-[#1E1B19] mt-1.5" id="selected-package-display">
                                            {{ $service['options'][0]['name'] }}
                                        </p>
                                    </div>
                                    <span class="bg-[#E35D25] text-white text-xs font-bold px-3.5 py-1.5 rounded-full shadow-sm whitespace-nowrap">
                                        Konsultasi Gratis
                                    </span>
                                </div>
                                
                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Nama Pelanggan</label>
                                    <input 
                                        type="text" 
                                        name="nama_pelanggan" 
                                        value="{{ old('nama_pelanggan', auth()->check() ? auth()->user()->name : '') }}" 
                                        placeholder="Nama atau instansi"
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                        required
                                    >
                                    @error('nama_pelanggan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">No. Whatsapp</label>
                                        <input 
                                            type="tel" 
                                            name="whatsapp_number" 
                                            value="{{ old('whatsapp_number', auth()->check() ? auth()->user()->whatsapp_number : '') }}" 
                                            placeholder="08xx-xxxx-xxxx"
                                            class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                            required
                                        >
                                        @error('whatsapp_number')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Email</label>
                                        <input 
                                            type="email" 
                                            name="email" 
                                            value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" 
                                            placeholder="nama@email.com"
                                            class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                            required
                                        >
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Budget Rakit PC (Rp)</label>
                                    <input 
                                        type="number" 
                                        name="budget_rakit" 
                                        value="{{ old('budget_rakit') }}" 
                                        placeholder="e.g. 15000000 (Kosongkan jika hanya service)"
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                    >
                                    @error('budget_rakit')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Detail Kebutuhan</label>
                                    <textarea 
                                        name="detail_kebutuhan" 
                                        rows="3" 
                                        placeholder="Tuliskan spesifikasi komponen, keluhan, atau layanan spesifik yang dibutuhkan..."
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200 resize-none"
                                        required
                                    >{{ old('detail_kebutuhan') }}</textarea>
                                    @error('detail_kebutuhan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2">Alamat Lokasi</label>
                                    <input 
                                        type="text" 
                                        name="alamat" 
                                        value="{{ old('alamat') }}" 
                                        placeholder="Alamat penjemputan PC / lokasi teknisi"
                                        class="w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200"
                                        required
                                    >
                                    @error('alamat')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                @if(session('error'))
                                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <button type="submit" class="w-full bg-[#E35D25] hover:bg-[#E35D25]/90 text-white font-bold py-4 px-8 rounded-xl transition-all duration-200 shadow-[0_4px_20px_-4px_rgba(227,93,37,0.4)] hover:shadow-[0_8px_25px_-5px_rgba(227,93,37,0.5)] hover:-translate-y-0.5 flex items-center justify-center group">
                                    <span>{{ $service['submit_button_text'] }}</span>
                                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </button>
                                <p class="text-[10px] font-semibold text-center text-[#1E1B19]/40 mt-4">
                                    Konsultasi awal gratis. Tim kami akan menghubungi Anda via WhatsApp.
                                </p>
                            </form>
                        @else
                            <!-- Generic Dynamic Form -->
                            <form action="{{ route('layanan.store', $service['slug']) }}" method="POST" class="space-y-5" id="order-form">
                                @csrf
                                
                                <!-- Hidden Field for selected package -->
                                <input type="hidden" name="package_selected" id="package-input" value="{{ $service['options'][0]['name'] }}">

                                <!-- Package Selected Indicator Text in Form -->
                                <div class="bg-[#F1EBE2] border border-[#e6decb]/40 rounded-2xl p-4 flex items-center justify-between">
                                    <div>
                                        <p class="text-[9px] font-extrabold uppercase tracking-widest text-[#1E1B19]/40 leading-none">Layanan Dipilih</p>
                                        <p class="text-sm font-bold text-[#1E1B19] mt-1.5" id="selected-package-display">
                                            {{ $service['options'][0]['name'] }}
                                        </p>
                                    </div>
                                    <span class="bg-[#E35D25] text-white text-xs font-bold px-3.5 py-1.5 rounded-full shadow-sm whitespace-nowrap">
                                        Konsultasi Gratis
                                    </span>
                                </div>
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

                                @if($service['slug'] === 'rakit-pc')
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
                    @endif
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

    @push('scripts')
        <script>
        @if($service['slug'] === 'printing-cetak')
            // ── Printing-cetak carousel JS ──
            const printOptions = @json($service['options']);
            let printActiveIndex = 0;

            function updatePrintCarousel() {
                const cards = document.querySelectorAll('.print-product-card');
                const n = cards.length;
                cards.forEach((card, i) => {
                    const pos = ((i - printActiveIndex) % n + n) % n;
                    // pos 0 = active/center, 1 = right, 2 = left
                    if (pos === 0) {
                        card.style.order = 2;
                        card.style.transform = 'scale(1)';
                        card.style.opacity = '1';
                        card.style.borderColor = '#E35D25';
                        card.style.boxShadow = '0 16px 40px rgba(227,93,37,0.18)';
                        card.style.zIndex = '3';
                    } else if (pos === 1) {
                        card.style.order = 3;
                        card.style.transform = 'scale(0.85)';
                        card.style.opacity = '0.5';
                        card.style.borderColor = '#e8e8e8';
                        card.style.boxShadow = 'none';
                        card.style.zIndex = '1';
                    } else {
                        card.style.order = 1;
                        card.style.transform = 'scale(0.85)';
                        card.style.opacity = '0.5';
                        card.style.borderColor = '#e8e8e8';
                        card.style.boxShadow = 'none';
                        card.style.zIndex = '1';
                    }
                });

                // Update detail sections
                document.querySelectorAll('.print-detail-section').forEach(el => {
                    el.classList.toggle('hidden', parseInt(el.dataset.index) !== printActiveIndex);
                });

                // Update form panels
                document.querySelectorAll('.print-form-panel').forEach(el => {
                    el.classList.toggle('hidden', parseInt(el.dataset.index) !== printActiveIndex);
                });

                // Update preview label
                const opt = printOptions[printActiveIndex];
                const previewEl = document.getElementById('print-preview-product');
                if (previewEl) previewEl.textContent = opt.name;
                const previewSub = document.getElementById('print-preview-sub');
                if (previewSub) previewSub.textContent = 'Letakkan foto contoh ' + opt.name + ' (opsional)';
            }

            function setPrintActive(index) {
                printActiveIndex = index;
                updatePrintCarousel();
            }

            function printCarouselPrev() {
                printActiveIndex = (printActiveIndex - 1 + printOptions.length) % printOptions.length;
                updatePrintCarousel();
            }

            function printCarouselNext() {
                printActiveIndex = (printActiveIndex + 1) % printOptions.length;
                updatePrintCarousel();
            }

            // ── Confirmation overlay logic ──
            const _printFieldLabels = {
                nama_perusahaan:  'Nama / Brand',
                no_whatsapp:      'No. WhatsApp',
                jumlah:           'Jumlah',
                ukuran:           'Ukuran',
                ukuran_cetak:     'Ukuran Cetak',
                jenis_cover:      'Jenis Cover',
                penjilidan:       'Penjilidan',
                jumlah_halaman:   'Jumlah Halaman',
                cover:            'Cover',
                kertas_isi:       'Kertas Isi',
                link_folder_foto: 'Link Folder Foto',
                finishing_kertas: 'Finishing Kertas',
                laminasi:         'Laminasi',
                masalah_utama:    'Catatan',
            };
            const _printFieldOrder = Object.keys(_printFieldLabels);
            let _activePrintForm = null;

            function showPrintConfirm(form) {
                _activePrintForm = form;
                const product = form.querySelector('[name="package_selected"]').value;
                document.getElementById('print-confirm-product').textContent = product;

                let html = '';
                _printFieldOrder.forEach(name => {
                    const el = form.querySelector(`[name="${name}"]`);
                    if (!el) return;
                    const val = el.value.trim();
                    if (!val) return;
                    html += `<div class="flex items-start justify-between gap-4 py-3">
                        <span class="text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/40 shrink-0 pt-0.5">${_printFieldLabels[name]}</span>
                        <span class="text-sm font-semibold text-[#1E1B19] text-right leading-snug">${val}</span>
                    </div>`;
                });

                document.getElementById('print-confirm-body').innerHTML = html;
                document.getElementById('print-confirm-overlay').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closePrintConfirm() {
                document.getElementById('print-confirm-overlay').classList.add('hidden');
                document.body.style.overflow = '';
                _activePrintForm = null;
            }

            function submitPrintForm() {
                if (_activePrintForm) {
                    _activePrintForm.submit();
                }
            }

            document.addEventListener('DOMContentLoaded', () => {
                updatePrintCarousel();
                // Intercept all 3 print form submissions
                document.querySelectorAll('.print-form-panel form').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        showPrintConfirm(this);
                    });
                });
                // Close overlay when clicking backdrop
                document.getElementById('print-confirm-overlay').addEventListener('click', function(e) {
                    if (e.target === this) closePrintConfirm();
                });
            });
        @else
            // ── Generic service package-selector JS ──
            const serviceOptions = @json($service['options']);

            function selectPackage(packageName, packageId, index) {
                document.getElementById('package-input').value = packageName;
                document.getElementById('selected-package-display').textContent = packageName;

                // Update styling of all cards
                document.querySelectorAll('.package-card').forEach(card => {
                    card.classList.remove('border-[#E35D25]', 'shadow-sm');
                    card.classList.add('border-[#eee]');
                });
                const selectedCard = document.getElementById('card-' + packageId);
                selectedCard.classList.remove('border-[#eee]');
                selectedCard.classList.add('border-[#E35D25]', 'shadow-sm');

                document.querySelectorAll('[id^="radio-outer-"]').forEach(outer => {
                    outer.classList.remove('border-[#E35D25]');
                    outer.classList.add('border-[#ccc]');
                });
                document.querySelectorAll('[id^="radio-inner-"]').forEach(inner => {
                    inner.classList.remove('scale-100');
                    inner.classList.add('scale-0');
                });
                document.getElementById('radio-outer-' + packageId).classList.remove('border-[#ccc]');
                document.getElementById('radio-outer-' + packageId).classList.add('border-[#E35D25]');
                document.getElementById('radio-inner-' + packageId).classList.remove('scale-0');
                document.getElementById('radio-inner-' + packageId).classList.add('scale-100');
            }
        @endif
        </script>
    @endpush
</x-layouts.app>







