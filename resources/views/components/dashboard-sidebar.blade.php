@props(['activeCount' => 0, 'historyCount' => 0])

@php
    $user = Illuminate\Support\Facades\Auth::user();

    // Tab aktif ditentukan oleh route saat ini, bukan toggle JS: Pesanan Aktif
    // di /akun, Riwayat di /akun/riwayat. Tab aktif memakai gaya solid gelap,
    // yang tidak aktif memakai gaya pill tenang (tint hover).
    $onRiwayat = request()->routeIs('akun.riwayat');
    $tabActive = 'flex items-center justify-between px-4 py-3 rounded-full bg-[#1E1B19] text-white text-sm font-semibold transition-all';
    $tabIdle   = 'flex items-center justify-between px-4 py-3 rounded-full text-[#1E1B19]/60 hover:text-[#1E1B19] hover:bg-[#1E1B19]/5 text-sm font-semibold transition-all';
@endphp

<div class="w-full md:w-80 shrink-0">
    <div class="bg-white rounded-3xl border border-[#1E1B19]/5 p-6 shadow-sm sticky top-24">

        <!-- Profile Card -->
        <div class="flex flex-col items-center text-center pb-6">
            <!-- Large Avatar + edit badge. Seluruh avatar adalah tombol pemicu
                 modal "Edit Foto Profil" (.jt-pp-trigger). Isinya .jt-avatar-slot
                 supaya bisa diperbarui langsung oleh JS setelah foto diganti
                 atau dihapus, tanpa memuat ulang halaman. -->
            <button type="button" class="jt-pp-trigger group relative mb-4 cursor-pointer" title="Ubah foto profil" aria-label="Ubah foto profil">
                <span class="jt-avatar-slot w-20 h-20 rounded-full bg-gradient-to-tr from-[#E35D25] to-[#f4733e] ring-4 ring-[#FBF9F6] text-white flex items-center justify-center shadow-lg shadow-[#E35D25]/20 select-none overflow-hidden">
                    <img src="{{ $user->profilePhotoUrl() ?? '' }}" alt="Foto profil {{ $user->name }}"
                         class="w-full h-full object-cover {{ $user->hasProfilePhoto() ? '' : 'hidden' }}">
                    <span class="jt-avatar-initial text-3xl font-extrabold font-serif-display {{ $user->hasProfilePhoto() ? 'hidden' : '' }}">{{ $user->initial() }}</span>
                </span>
                <span class="absolute -bottom-0.5 -right-0.5 w-7 h-7 rounded-full bg-[#1E1B19] text-white flex items-center justify-center ring-2 ring-white transition-colors duration-300 group-hover:bg-[#E35D25]">
                    <!-- Pencil Icon -->
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487z"></path>
                    </svg>
                </span>
            </button>

            <!-- User Info -->
            <h4 class="font-serif-display text-xl font-bold text-[#1E1B19]">
                {{ $user->name }}
            </h4>
            @if($user->whatsapp_number)
                <p class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#1E1B19]/50 mt-2">
                    <!-- Phone Icon -->
                    <svg class="w-3.5 h-3.5 text-[#E35D25]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"></path>
                    </svg>
                    {{ $user->whatsapp_number }}
                </p>
            @endif
            <p class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#1E1B19]/50 mt-1">
                <!-- Mail Icon -->
                <svg class="w-3.5 h-3.5 text-[#E35D25]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"></path>
                </svg>
                {{ $user->email }}
            </p>
        </div>

        <!-- Sidebar Navigation Menu -->
        <div class="py-6 space-y-2 border-t border-[#1E1B19]/5">
            <!-- Tab: Pesanan Aktif -->
            <a href="{{ route('akun') }}" class="{{ $onRiwayat ? $tabIdle : $tabActive }}">
                <div class="flex items-center gap-3">
                    <!-- Router Icon -->
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <rect x="3" y="13.5" width="18" height="6" rx="1.5"></rect>
                        <path d="M7.5 13.5l-1.5-5"></path>
                        <path d="M16.5 13.5l1.5-5"></path>
                        <path d="M6.5 16.5h.01"></path>
                        <path d="M9.5 16.5h.01"></path>
                        <path d="M15.5 16.5h2.5"></path>
                    </svg>
                    <span>Pesanan Aktif</span>
                </div>
                <span class="w-5 h-5 rounded-full {{ $onRiwayat ? 'bg-[#1E1B19]/10 text-[#1E1B19]/60' : 'bg-[#E35D25] text-white' }} text-[10px] font-bold flex items-center justify-center">{{ $activeCount }}</span>
            </a>

            <!-- Tab: Riwayat -->
            <a href="{{ route('akun.riwayat') }}" class="{{ $onRiwayat ? $tabActive : $tabIdle }}">
                <div class="flex items-center gap-3">
                    <!-- Clock Icon -->
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Riwayat</span>
                </div>
                <span class="w-5 h-5 rounded-full {{ $onRiwayat ? 'bg-[#E35D25] text-white' : 'bg-[#1E1B19]/10 text-[#1E1B19]/60' }} text-[10px] font-bold flex items-center justify-center">{{ $historyCount }}</span>
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

{{-- Modal edit foto profil (utama + cropper + konfirmasi hapus). Diletakkan di
     sini supaya ikut hadir di semua halaman yang memakai sidebar ini. --}}
<x-profile-photo-modal :user="$user" />
