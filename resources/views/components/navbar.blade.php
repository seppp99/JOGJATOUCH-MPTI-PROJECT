<!-- SECTION 1: HEADER & NAVIGATION -->
<header class="sticky top-0 z-50 w-full bg-[#FBF9F6]/85 backdrop-blur-md border-b border-[#1E1B19]/5">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        
        <!-- Logo -->
        <a href="#" class="flex items-center gap-2 group">
            <div class="w-15 h-15 rounded-xl bg-[#FFFFFF] flex items-center justify-center text-white font-bold text-xl shadow-md shadow-[#E35D25]/20 group-hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('assets/logo jogja touch border white.png') }}" alt="Jogja Touch Logo" class="w-12 h-12">
            </div>
            <span class="font-serif-display font-bold text-xl tracking-tight">Jogja<span class="text-[#E35D25]">touch</span></span>
        </a>

        <!-- Desktop Navigation Menu Pills -->
        <nav class="hidden md:flex items-center bg-[#1E1B19]/5 p-1 rounded-full border border-[#1E1B19]/5">
            <a href="#" class="px-5 py-2 rounded-full text-sm font-medium bg-[#1E1B19] text-white shadow-sm transition-all duration-300">Beranda</a>
            <a href="#tentang" class="px-5 py-2 rounded-full text-sm font-medium text-[#1E1B19]/70 hover:text-[#1E1B19] hover:bg-white/60 transition-all duration-300">Tentang kami</a>
            <a href="#layanan" class="px-5 py-2 rounded-full text-sm font-medium text-[#1E1B19]/70 hover:text-[#1E1B19] hover:bg-white/60 transition-all duration-300">Layanan</a>
            <a href="#fitur" class="px-5 py-2 rounded-full text-sm font-medium text-[#1E1B19]/70 hover:text-[#1E1B19] hover:bg-white/60 transition-all duration-300">Fitur</a>
            <a href="#tracking" class="px-5 py-2 rounded-full text-sm font-medium text-[#1E1B19]/70 hover:text-[#1E1B19] hover:bg-white/60 transition-all duration-300">Cek Pesanan</a>
        </nav>

        <!-- CTA Button (Desktop) -->
        <div class="hidden md:block">
            <a href="#cta" class="inline-flex items-center justify-center px-6 py-3 rounded-full text-sm font-semibold bg-[#E35D25] text-white hover:bg-[#c74c1a] transition-colors duration-300 shadow-lg shadow-[#E35D25]/15">
                Hubungi Kami
            </a>
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
        <nav class="flex flex-col space-y-3">
            <a href="#" class="px-4 py-2.5 rounded-xl text-base font-semibold bg-[#1E1B19]/5 text-[#1E1B19]">Beranda</a>
            <a href="#tentang" class="px-4 py-2.5 rounded-xl text-base font-semibold text-[#1E1B19]/80 hover:bg-[#1E1B19]/5 transition-all">Tentang kami</a>
            <a href="#layanan" class="px-4 py-2.5 rounded-xl text-base font-semibold text-[#1E1B19]/80 hover:bg-[#1E1B19]/5 transition-all">Layanan</a>
            <a href="#fitur" class="px-4 py-2.5 rounded-xl text-base font-semibold text-[#1E1B19]/80 hover:bg-[#1E1B19]/5 transition-all">Fitur</a>
            <a href="#tracking" class="px-4 py-2.5 rounded-xl text-base font-semibold text-[#1E1B19]/80 hover:bg-[#1E1B19]/5 transition-all">Cek Pesanan</a>
        </nav>
        <div class="pt-4 border-t border-[#1E1B19]/5">
            <a href="#cta" class="w-full flex items-center justify-center px-6 py-3.5 rounded-xl text-base font-semibold bg-[#E35D25] text-white hover:bg-[#c74c1a] transition-colors shadow-md">
                Hubungi Kami
            </a>
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

    // Close mobile menu on clicking any link
    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
            menuOpenIcon.classList.remove('hidden');
            menuCloseIcon.classList.add('hidden');
        });
    });
</script>
@endpush
