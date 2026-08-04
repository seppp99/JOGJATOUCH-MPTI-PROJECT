<?php
$path = 'resources/views/pages/layanan-detail.blade.php';
$content = file_get_contents($path);

// Find the generic form block which starts with:
// <form action="{{ route('layanan.store', $service['slug']) }}" method="POST" class="space-y-5" id="order-form">
// And inside it, there is @if($service['slug'] === 'network-analyst') ... @else ... @endif

$pattern = '/(@if\(\\\[\'slug\'\] === \'network-analyst\'\))(.*?)@else(.*?)@endif/s';
if (preg_match($pattern, $content, $matches)) {
    // $matches[2] contains the old network analyst fields
    // $matches[3] contains the generic fields
    
    // We want to KEEP $matches[3] in place, and REMOVE the @if..@else..@endif wrapper inside the generic form.
    // So the generic form will just have the generic fields directly.
    $newGenericFields = $matches[3];
    $content = str_replace($matches[0], $newGenericFields, $content);
    
    // Now we need to insert the new @elseif($service['slug'] === 'network-analyst') BEFORE the @else
    // The @else that contains the generic form looks like this:
    /*
        @elseif($service['slug'] === 'pemasangan-wifi')
            ...
        @else
            <form action="{{ route('layanan.store', $service['slug']) }}"
    */
    
    $newBlock = "
                            @elseif(\\['slug'] === 'network-analyst')
                                <!-- Network Analyst Fields (Isolated) -->
                                <form action=\"{{ route('layanan.network.order') }}\" method=\"POST\" class=\"space-y-5\" id=\"order-form\">
                                    @csrf
                                    
                                    <!-- Hidden Field for selected package -->
                                    <input type=\"hidden\" name=\"paket_dipilih\" id=\"package-input\" value=\"{{ \\\['options'][0]['name'] }}\">

                                    <!-- Package Selected Indicator Text in Form -->
                                    <div class=\"bg-[#F1EBE2] border border-[#e6decb]/40 rounded-2xl p-4 flex items-center justify-between\">
                                        <div>
                                            <p class=\"text-[9px] font-extrabold uppercase tracking-widest text-[#1E1B19]/40 leading-none\">Layanan Dipilih</p>
                                            <p class=\"text-sm font-bold text-[#1E1B19] mt-1.5\" id=\"selected-package-display\">
                                                {{ \\\['options'][0]['name'] }}
                                            </p>
                                        </div>
                                        <span class=\"bg-[#E35D25] text-white text-xs font-bold px-3.5 py-1.5 rounded-full shadow-sm whitespace-nowrap\">
                                            Konsultasi Gratis
                                        </span>
                                    </div>
                                    
                                    <div>
                                        <label class=\"block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2\">Nama / Perusahaan</label>
                                        <input 
                                            type=\"text\" 
                                            name=\"nama_pelanggan\" 
                                            value=\"{{ old('nama_pelanggan', auth()->check() ? auth()->user()->name : '') }}\" 
                                            placeholder=\"Nama atau perusahaan\"
                                            class=\"w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200\"
                                            required
                                        >
                                        @error('nama_pelanggan')
                                            <p class=\"text-red-500 text-xs mt-1\">{{ \\\ }}</p>
                                        @enderror
                                    </div>

                                    <div class=\"grid grid-cols-1 md:grid-cols-2 gap-4\">
                                        <div>
                                            <label class=\"block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2\">No. Whatsapp</label>
                                            <input 
                                                type=\"tel\" 
                                                name=\"whatsapp_number\" 
                                                value=\"{{ old('whatsapp_number', auth()->check() ? auth()->user()->whatsapp_number : '') }}\" 
                                                placeholder=\"08xx-xxxx-xxxx\"
                                                class=\"w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200\"
                                                required
                                            >
                                            @error('whatsapp_number')
                                                <p class=\"text-red-500 text-xs mt-1\">{{ \\\ }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class=\"block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2\">Email Kerja</label>
                                            <input 
                                                type=\"email\" 
                                                name=\"email\" 
                                                value=\"{{ old('email', auth()->check() ? auth()->user()->email : '') }}\" 
                                                placeholder=\"nama@perusahaan.com\"
                                                class=\"w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200\"
                                                required
                                            >
                                            @error('email')
                                                <p class=\"text-red-500 text-xs mt-1\">{{ \\\ }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class=\"grid grid-cols-1 md:grid-cols-2 gap-4\">
                                        <div>
                                            <label class=\"block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2\">Jumlah Karyawan</label>
                                            <input 
                                                type=\"number\" 
                                                name=\"jumlah_karyawan\" 
                                                value=\"{{ old('jumlah_karyawan') }}\" 
                                                placeholder=\"1-10\"
                                                class=\"w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200\"
                                            >
                                            @error('jumlah_karyawan')
                                                <p class=\"text-red-500 text-xs mt-1\">{{ \\\ }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class=\"block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2\">Jumlah Lokasi</label>
                                            <input 
                                                type=\"number\" 
                                                name=\"jumlah_lokasi\" 
                                                value=\"{{ old('jumlah_lokasi') }}\" 
                                                placeholder=\"1\"
                                                class=\"w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200\"
                                            >
                                            @error('jumlah_lokasi')
                                                <p class=\"text-red-500 text-xs mt-1\">{{ \\\ }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label class=\"block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2\">Perangkat Utama Saat Ini</label>
                                        <input 
                                            type=\"text\" 
                                            name=\"perangkat_utama\" 
                                            value=\"{{ old('perangkat_utama') }}\" 
                                            placeholder=\"Mikrotik\"
                                            class=\"w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200\"
                                        >
                                        @error('perangkat_utama')
                                            <p class=\"text-red-500 text-xs mt-1\">{{ \\\ }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class=\"block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2\">Masalah Utama</label>
                                        <textarea 
                                            name=\"detail_kebutuhan\" 
                                            rows=\"3\" 
                                            placeholder=\"Mis: koneksi sering putus, lambat di jam sibuk, sinyal tidak merata...\"
                                            class=\"w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200 resize-none\"
                                            required
                                        >{{ old('detail_kebutuhan') }}</textarea>
                                        @error('detail_kebutuhan')
                                            <p class=\"text-red-500 text-xs mt-1\">{{ \\\ }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class=\"block text-[10px] font-extrabold uppercase tracking-widest text-[#1E1B19]/50 mb-2\">Alamat Lokasi</label>
                                        <input 
                                            type=\"text\" 
                                            name=\"alamat\" 
                                            value=\"{{ old('alamat') }}\" 
                                            placeholder=\"Alamat kantor\"
                                            class=\"w-full bg-white border border-[#e8dfd3] rounded-xl px-4 py-3.5 text-sm font-medium placeholder-[#1E1B19]/35 focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all duration-200\"
                                            required
                                        >
                                        @error('alamat')
                                            <p class=\"text-red-500 text-xs mt-1\">{{ \\\ }}</p>
                                        @enderror
                                    </div>
                                    
                                    @if(session('error'))
                                        <div class=\"p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50\">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <button type=\"submit\" class=\"w-full bg-[#E35D25] hover:bg-[#E35D25]/90 text-white font-bold py-4 px-8 rounded-xl transition-all duration-200 shadow-[0_4px_20px_-4px_rgba(227,93,37,0.4)] hover:shadow-[0_8px_25px_-5px_rgba(227,93,37,0.5)] hover:-translate-y-0.5 flex items-center justify-center group\">
                                        <span>{{ \\\['submit_button_text'] }}</span>
                                        <svg class=\"w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M14 5l7 7m0 0l-7 7m7-7H3\" />
                                        </svg>
                                    </button>
                                    <p class=\"text-[10px] font-semibold text-center text-[#1E1B19]/40 mt-4\">
                                        Konsultasi awal gratis. Tim kami akan menghubungi Anda via WhatsApp.
                                    </p>
                                </form>
                            @else
    ";

    // Re-insert the new block before the generic @else
    $content = str_replace('@else', $newBlock, $content);
    file_put_contents($path, $content);
    echo "SUCCESS\n";
} else {
    echo "FAILED TO FIND PATTERN\n";
}
?>
