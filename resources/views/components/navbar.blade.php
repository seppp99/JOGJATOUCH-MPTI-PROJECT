<!-- SECTION 1: HEADER & NAVIGATION -->
<style>
    .nav-cb {
        color: #c8961e;
        border: 1px solid rgba(200,150,30,0.3);
        border-radius: 999px;
        background: transparent;
        transition: all 0.3s ease;
        position: relative;
    }
    .nav-cb:hover {
        color: #F4C430 !important;
        border-color: rgba(244,196,48,0.7);
        background: #0D1B2A;
        box-shadow: 0 0 16px rgba(244,196,48,0.4), 0 0 32px rgba(244,196,48,0.2);
    }
    /* mobile rounded-xl variant */
    .nav-cb-mobile {
        color: #c8961e;
        border: 1px solid rgba(200,150,30,0.25);
        border-radius: 12px;
        background: transparent;
        transition: all 0.3s ease;
    }
    .nav-cb-mobile:hover {
        color: #F4C430 !important;
        border-color: rgba(244,196,48,0.6);
        background: #0D1B2A;
        box-shadow: 0 0 12px rgba(244,196,48,0.3);
    }
</style>
<header class="sticky top-0 z-50 w-full bg-[#FBF9F6]/85 backdrop-blur-md border-b border-[#1E1B19]/5">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        
        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center gap-2 group">
            <div class="w-15 h-15 rounded-xl bg-[#FFFFFF] flex items-center justify-center text-white font-bold text-xl shadow-md shadow-[#E35D25]/20 group-hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('assets/logo jogja touch border white.png') }}" alt="Jogja Touch Logo" class="w-12 h-12">
            </div>
            <span class="font-serif-display font-bold text-xl tracking-tight">Jogja<span class="text-[#E35D25]">touch</span></span>
        </a>

        <!-- Desktop Navigation Menu Pills -->
        {{-- Menu navigasi SAMA untuk tamu maupun pengguna yang sudah login.
             Dulu dipecah @auth/@else dan isinya sempat menyimpang: label
             "Portfolio" vs "Fitur", kapitalisasi "Tentang kami" vs "Tentang
             Kami", dan tamu tidak mendapat "Hubungi Kami". Ditulis satu kali
             supaya perbedaan seperti itu tidak bisa terjadi lagi. --}}
        <nav class="hidden md:flex items-center bg-[#1E1B19]/5 p-1 rounded-full border border-[#1E1B19]/5">
            <a href="{{ request()->is('/') ? '#home' : '/#home' }}" class="nav-pill px-5 py-2 rounded-full text-sm font-medium text-[#1E1B19]/70 hover:text-[#1E1B19] hover:bg-white/60 transition-all duration-300">Beranda</a>
            <a href="{{ request()->is('/') ? '#tentang' : '/#tentang' }}" class="nav-pill px-5 py-2 rounded-full text-sm font-medium text-[#1E1B19]/70 hover:text-[#1E1B19] hover:bg-white/60 transition-all duration-300">Tentang Kami</a>
            <a href="{{ request()->is('/') ? '#layanan' : '/#layanan' }}" class="nav-pill px-5 py-2 rounded-full text-sm font-medium text-[#1E1B19]/70 hover:text-[#1E1B19] hover:bg-white/60 transition-all duration-300">Layanan</a>
            <a href="{{ request()->is('/') ? '#fitur' : '/#fitur' }}" class="nav-pill px-5 py-2 rounded-full text-sm font-medium text-[#1E1B19]/70 hover:text-[#1E1B19] hover:bg-white/60 transition-all duration-300">Fitur</a>
            <a href="{{ request()->is('/') ? '#cta' : '/#cta' }}" class="nav-pill px-5 py-2 rounded-full text-sm font-medium text-[#1E1B19]/70 hover:text-[#1E1B19] hover:bg-white/60 transition-all duration-300">Hubungi Kami</a>
            <a href="{{ url('/team-corebyte') }}" class="nav-cb px-5 py-2 text-sm font-semibold">Team Corebyte</a>
        </nav>

        <!-- Right Side Actions (Desktop) -->
        <div class="hidden md:flex items-center gap-4">
            @auth
                <!-- Logged In User Dropdown -->
                <div class="relative" id="user-dropdown-container">
                    <button onclick="toggleUserDropdown()" class="flex items-center gap-2.5 px-4 py-2 rounded-full border border-[#1E1B19]/10 bg-white hover:bg-[#FBF9F6] text-sm font-semibold transition-all">
                        <span class="jt-avatar-slot w-8 h-8 rounded-full bg-[#E35D25] text-white flex items-center justify-center overflow-hidden shrink-0">
                            <img src="{{ Auth::user()->profilePhotoUrl() ?? '' }}" alt="Foto profil"
                                 class="w-full h-full object-cover {{ Auth::user()->hasProfilePhoto() ? '' : 'hidden' }}">
                            <span class="jt-avatar-initial text-sm font-bold {{ Auth::user()->hasProfilePhoto() ? 'hidden' : '' }}">{{ Auth::user()->initial() }}</span>
                        </span>
                        <span class="text-[#1E1B19]">{{ Auth::user()->name }}</span>
                        <!-- Chevron Icon -->
                        <svg class="w-4 h-4 text-[#1E1B19]/50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white border border-[#1E1B19]/10 rounded-2xl shadow-xl py-2 z-50">
                        {{-- Pola `akun*` mencakup SEMUA halaman dashboard akun:
                             akun, akun.riwayat, dan akun.pesanan.detail.
                             Sebelumnya hanya `akun` yang dicocokkan, sehingga
                             tautan "Dashboard Akun" tetap muncul di halaman
                             Riwayat dan Detail Pesanan - padahal perpindahan
                             antar-halaman itu sudah disediakan sidebar. --}}
                        @unless(request()->routeIs('akun*'))
                            <a href="{{ route('akun') }}" class="block px-5 py-3 text-sm font-medium text-[#1E1B19]/80 hover:bg-[#1E1B19]/5 hover:text-[#1E1B19]">Dashboard Akun</a>
                            <hr class="border-[#1E1B19]/5">
                        @endunless
                        <a href="{{ route('logout') }}" class="block px-5 py-3 text-sm font-medium text-red-500 hover:bg-red-500/5">Keluar</a>
                    </div>
                </div>

                <!-- Pesan Layanan CTA -->
                <a href="{{ request()->is('/') ? '#layanan' : '/#layanan' }}" class="inline-flex items-center justify-center gap-1.5 px-6 py-3 rounded-full text-sm font-semibold bg-[#E35D25] text-white hover:bg-[#c74c1a] transition-colors duration-300 shadow-lg shadow-[#E35D25]/15">
                    <span>Pesan Layanan</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            @else
                <!-- Guest CTA / Masuk & Daftar -->
                <a href="{{ route('login') }}" class="text-sm font-semibold text-[#1E1B19]/70 hover:text-[#1E1B19] transition-colors px-4 py-2">
                    Masuk
                </a>
                <a href="{{ route('daftar') }}" class="cursor-pointer inline-flex items-center justify-center px-6 py-3 rounded-full text-sm font-semibold bg-[#E35D25] text-white hover:bg-[#c74c1a] transition-colors duration-300 shadow-lg shadow-[#E35D25]/15">
                    Daftar
                </a>
            @endauth
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-toggle" class="md:hidden p-2 rounded-lg text-[#1E1B19] hover:bg-[#1E1B19]/5 transition-colors focus:outline-none" aria-label="Toggle Menu">
            <svg id="menu-icon-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
            <svg id="menu-icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div id="mobile-menu" class="hidden md:hidden w-full bg-[#FBF9F6] border-t border-[#1E1B19]/5 px-6 py-6 space-y-4 absolute left-0 right-0 shadow-lg">
        {{-- Lima item pertama identik dengan menu desktop dan sama untuk tamu
             maupun pengguna login. Hanya tautan khusus akun (Dashboard, Keluar)
             yang bergantung status login - tamu memang tidak punya keduanya. --}}
        <nav class="flex flex-col space-y-3">
            <a href="{{ request()->is('/') ? '#home' : '/#home' }}" class="nav-pill px-4 py-2.5 rounded-xl text-base font-semibold text-[#1E1B19]/80 hover:bg-[#1E1B19]/5 transition-all">Beranda</a>
            <a href="{{ request()->is('/') ? '#tentang' : '/#tentang' }}" class="nav-pill px-4 py-2.5 rounded-xl text-base font-semibold text-[#1E1B19]/80 hover:bg-[#1E1B19]/5 transition-all">Tentang Kami</a>
            <a href="{{ request()->is('/') ? '#layanan' : '/#layanan' }}" class="nav-pill px-4 py-2.5 rounded-xl text-base font-semibold text-[#1E1B19]/80 hover:bg-[#1E1B19]/5 transition-all">Layanan</a>
            <a href="{{ request()->is('/') ? '#fitur' : '/#fitur' }}" class="nav-pill px-4 py-2.5 rounded-xl text-base font-semibold text-[#1E1B19]/80 hover:bg-[#1E1B19]/5 transition-all">Fitur</a>
            <a href="{{ request()->is('/') ? '#cta' : '/#cta' }}" class="nav-pill px-4 py-2.5 rounded-xl text-base font-semibold text-[#1E1B19]/80 hover:bg-[#1E1B19]/5 transition-all">Hubungi Kami</a>
            <a href="{{ url('/team-corebyte') }}" class="nav-cb-mobile px-4 py-2.5 text-base font-semibold">Team Corebyte</a>

            @auth
                {{-- Sama seperti dropdown desktop: `akun*` menutup seluruh
                     halaman dashboard akun, bukan hanya /akun. --}}
                @unless(request()->routeIs('akun*'))
                    <a href="{{ route('akun') }}" class="nav-pill px-4 py-2.5 rounded-xl text-base font-semibold text-[#1E1B19]/80 hover:bg-[#1E1B19]/5 transition-all">Dashboard Akun</a>
                @endunless
                <a href="{{ route('logout') }}" class="nav-pill px-4 py-2.5 rounded-xl text-base font-semibold text-red-500 hover:bg-red-500/5 transition-all">Keluar</a>
            @endauth
        </nav>
        <div class="pt-4 border-t border-[#1E1B19]/5">
            @auth
                <a href="{{ request()->is('/') ? '#layanan' : '/#layanan' }}" class="w-full flex items-center justify-center gap-1.5 px-6 py-3.5 rounded-xl text-base font-semibold bg-[#E35D25] text-white hover:bg-[#c74c1a] transition-colors shadow-md">
                    <span>Pesan Layanan</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            @else
                <div class="flex flex-col gap-2.5">
                    <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-6 py-3.5 rounded-xl text-base font-semibold border border-[#1E1B19]/10 bg-white text-[#1E1B19] hover:bg-[#FBF9F6] transition-colors shadow-sm">
                        Masuk
                    </a>
                    <a href="{{ route('daftar') }}" class="w-full flex items-center justify-center px-6 py-3.5 rounded-xl text-base font-semibold bg-[#E35D25] text-white hover:bg-[#c74c1a] transition-colors shadow-md">
                        Daftar
                    </a>
                </div>
            @endauth
        </div>
    </div>
</header>


@push('scripts')
<script>
    // Mobile Menu Open/Close Drawer Toggle
    const menuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuOpenIcon = document.getElementById('menu-icon-open');
    const menuCloseIcon = document.getElementById('menu-icon-close');

    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.contains('hidden');
            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                menuOpenIcon.classList.add('hidden');
                menuCloseIcon.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
                menuOpenIcon.classList.remove('hidden');
                menuCloseIcon.classList.add('hidden');
            }
        });
    }

    // Close mobile menu on clicking any link
    if (mobileMenu) {
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                menuOpenIcon.classList.remove('hidden');
                menuCloseIcon.classList.add('hidden');
            });
        });
    }

    // Toggle User Profile Dropdown
    function toggleUserDropdown() {
        const dropdown = document.getElementById('user-dropdown');
        if (dropdown) {
            dropdown.classList.toggle('hidden');
        }
    }

    // Close user dropdown when clicking outside
    document.addEventListener('click', (e) => {
        const container = document.getElementById('user-dropdown-container');
        const dropdown = document.getElementById('user-dropdown');
        if (container && dropdown && !container.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
@endpush
