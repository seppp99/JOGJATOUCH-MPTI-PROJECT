<!-- SECTION 2: HERO SECTION -->
<section id="home" class="relative pt-12 pb-24 md:pt-20 md:pb-32 overflow-hidden scroll-mt-24">
    <!-- Glow background decor -->
    <div class="absolute -top-40 right-0 w-[600px] h-[600px] bg-glow-orange pointer-events-none rounded-full"></div>
    
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            
            <!-- Left Hero Content -->
            <div class="lg:col-span-7 flex flex-col items-start text-left">
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold tracking-wider text-[#E35D25] bg-[#E35D25]/10 border border-[#E35D25]/20 mb-6 uppercase">
                    ✨ Kreativitas Tanpa Batas
                </span>
                
                <h1 class="font-serif-display text-5xl md:text-7xl font-semibold tracking-tight text-[#1E1B19] leading-[1.1] mb-6">
                    Teknologi <span class="font-normal italic text-[#E35D25] font-serif-display">&</span><br>kreativitas
                </h1>
                
                <p class="text-lg text-[#1E1B19]/80 leading-relaxed mb-8 max-w-xl">
                    Jogjatouch adalah mitra teknologi dan kreatif terpercaya di Yogyakarta. Kami menghadirkan solusi perakitan hardware, maintenance sistem komputer, desain grafis premium, hingga layanan cetak (printing) berkualitas tinggi untuk mewujudkan visi dan kebutuhan Anda.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                    <a href="#layanan" class="inline-flex items-center justify-center px-8 py-4 rounded-full text-base font-semibold bg-[#1E1B19] text-white hover:bg-[#332e2c] hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 shadow-xl shadow-black/10 group">
                        Mulai Proyek
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                    <a href="#tentang" class="inline-flex items-center justify-center px-8 py-4 rounded-full text-base font-semibold border-b-2 border-transparent hover:border-[#1E1B19] text-[#1E1B19] transition-all duration-200">
                        Lihat Layanan
                    </a>
                </div>
            </div>

            <!-- Right Hero Mockup Image (Matches target illustration) -->
            <div class="lg:col-span-5 relative w-full flex items-center justify-center">
                <div class="relative w-80 h-80 md:w-112 md:h-112 flex items-center justify-center">
                    
                    <!-- Main Solid Orange Circle Background -->
                    <div class="absolute w-64 h-64 md:w-88 md:h-88 bg-gradient-to-tr from-[#E35D25] to-[#f4733e] rounded-full shadow-2xl flex items-center justify-center overflow-hidden animate-pulse" style="animation-duration: 6s;">
                        
                        <!-- Curved decorative overlay lines inside circle -->
                        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
                    </div>
                    
                    <!-- Smartphone Mockup Overlay -->
                    <div class="absolute w-36 h-64 md:w-48 md:h-88 bg-[#FBF9F6] rounded-3xl shadow-2xl border-4 border-[#1E1B19] flex flex-col justify-between p-3 rotate-12 transform hover:rotate-6 transition-all duration-500 z-10">
                        <!-- Phone Notch -->
                        <div class="w-16 h-3 bg-[#1E1B19] rounded-full mx-auto mb-4"></div>
                        
                        <!-- Content Screen (Jogjatouch Graphic) -->
                        <div class="flex-1 rounded-xl bg-gradient-to-b from-[#FFF2EC] to-[#FFE6DA] flex flex-col items-center justify-center p-3 relative overflow-hidden">
                            <!-- Inner Orange "J" Logo in phone -->
                            <div class="w-12 h-12 rounded-xl bg-[#FFFFFF] flex items-center justify-center text-white font-bold text-xl shadow-md shadow-[#E35D25]/20 group-hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('assets/logo jogja touch border white.png') }}" alt="Jogja Touch Logo" class="w-10 h-10">
                            </div>
                            <!-- Vertical text inside smartphone mockup -->
                            <div class="text-[12px] md:text-xs font-bold tracking-widest text-[#1E1B19]/70 uppercase z-10 flex flex-col items-center gap-1 font-serif-display italic mt-3">
                                <span>J</span>
                                <span>O</span>
                                <span>G</span>
                                <span>J</span>
                                <span>A</span>
                            </div>
                            <div class="text-[9px] md:text-[10px] font-semibold text-[#E35D25] tracking-widest uppercase mt-2 z-10">
                                TOUCH
                            </div>
                        </div>
                        
                        <!-- Phone Home Indicator -->
                        <div class="w-12 h-1 bg-[#1E1B19]/30 rounded-full mx-auto mt-3"></div>
                    </div>

                    <!-- White Overlay Circles (Depth and Mockup feel) -->
                    <div class="absolute top-2 left-6 w-16 h-16 md:w-20 md:h-20 bg-white/90 backdrop-blur-md rounded-full shadow-lg border border-white/40 z-20 flex items-center justify-center animate-bounce" style="animation-duration: 4s;">
                        <div class="w-3 h-3 bg-[#E35D25] rounded-full"></div>
                    </div>
                    
                    <div class="absolute bottom-6 right-6 w-20 h-20 md:w-28 md:h-28 bg-white/80 backdrop-blur-md rounded-full shadow-lg border border-white/30 z-20 flex flex-col items-center justify-center text-center p-2">
                        <span class="font-serif-display text-lg md:text-xl font-bold text-[#E35D25]">J</span>
                        <span class="text-[8px] md:text-[9px] tracking-wider uppercase font-semibold text-[#1E1B19]/60">Touch</span>
                    </div>

                    <!-- Decorative background dots -->
                    <svg class="absolute -bottom-8 -left-8 text-[#1E1B19]/10 w-24 h-24" fill="currentColor" viewBox="0 0 100 100">
                        <rect width="100" height="100" fill="none"/>
                        <circle cx="10" cy="10" r="3" /> <circle cx="30" cy="10" r="3" /> <circle cx="50" cy="10" r="3" /> <circle cx="70" cy="10" r="3" /> <circle cx="90" cy="10" r="3" />
                        <circle cx="10" cy="30" r="3" /> <circle cx="30" cy="30" r="3" /> <circle cx="50" cy="30" r="3" /> <circle cx="70" cy="30" r="3" /> <circle cx="90" cy="30" r="3" />
                        <circle cx="10" cy="50" r="3" /> <circle cx="30" cy="50" r="3" /> <circle cx="50" cy="50" r="3" /> <circle cx="70" cy="50" r="3" /> <circle cx="90" cy="50" r="3" />
                        <circle cx="10" cy="70" r="3" /> <circle cx="30" cy="70" r="3" /> <circle cx="50" cy="70" r="3" /> <circle cx="70" cy="70" r="3" /> <circle cx="90" cy="70" r="3" />
                        <circle cx="10" cy="90" r="3" /> <circle cx="30" cy="90" r="3" /> <circle cx="50" cy="90" r="3" /> <circle cx="70" cy="90" r="3" /> <circle cx="90" cy="90" r="3" />
                    </svg>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- SECTION 3: TENTANG KAMI — Stats / Metrics Grid (section terpisah agar scroll spy bekerja) -->
<section id="tentang" class="py-24 bg-[#FBF9F6] scroll-mt-24">
    <div class="max-w-6xl mx-auto px-6">
        
        <!-- Optional Section Header inside Tentang Kami -->
        <div class="text-center mb-16">
            <span class="text-xs font-bold text-[#E35D25] tracking-widest uppercase block mb-4">TENTANG KAMI</span>
            <h2 class="font-serif-display text-4xl md:text-5xl font-semibold tracking-tight text-[#1E1B19] leading-none">
                Pekerjaan yang telah <span class="italic text-[#E35D25] font-serif-display">kami selesaikan.</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-8">
            
            <!-- Card 1: Kualitas Premium -->
            <div class="relative group overflow-hidden h-[340px] rounded-[24px] bg-[#26221F] shadow-lg transition-transform duration-300 hover:-translate-y-1">
                <!-- Image Tag (siap dimasukkan di public/assets/about/kualitas.jpg) -->
                @if(file_exists(public_path('assets/about/kualitas.jpg')))
                    <img src="{{ asset('assets/about/kualitas.jpg') }}" alt="Kualitas Premium" class="absolute inset-0 w-full h-full object-cover z-0 transition-transform duration-500 group-hover:scale-105">
                    <!-- Overlay Dark to ensure readability -->
                    <div class="absolute inset-0 bg-[#26221F]/80 z-10 transition-opacity duration-300 group-hover:bg-[#26221F]/85"></div>
                @else
                    <!-- Fallback Gradient matching mockup Card 1 (Dark brown/charcoal) -->
                    <div class="absolute inset-0 bg-gradient-to-b from-[#2E2925] to-[#1E1B19] z-10"></div>
                @endif
                
                <!-- Card Content -->
                <div class="relative z-20 h-full flex flex-col items-center justify-center text-center p-8 transition-all duration-300">
                    <span class="absolute top-6 right-8 text-[44px] font-serif font-medium leading-none text-white/10 select-none">01</span>
                    
                    <h3 class="font-serif text-3xl font-medium text-white transition-all duration-300 group-hover:-translate-y-1">
                        Kualitas Premium
                    </h3>
                    
                    <!-- Reveal on Hover description -->
                    <p class="text-sm text-white/80 leading-relaxed max-w-[280px] mt-4 opacity-0 max-h-0 overflow-hidden transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:max-h-[140px] transform translate-y-4 group-hover:translate-y-0">
                        Kami selalu menghadirkan layanan terbaik dengan material, komponen, dan standardisasi pengerjaan kelas premium untuk kenyamanan jangka panjang.
                    </p>
                </div>
            </div>

            <!-- Card 2: Tepat Waktu -->
            <div class="relative group overflow-hidden h-[340px] rounded-[24px] bg-[#A0522D] shadow-lg transition-transform duration-300 hover:-translate-y-1">
                <!-- Image Tag (siap dimasukkan di public/assets/about/waktu.jpg) -->
                @if(file_exists(public_path('assets/about/waktu.jpg')))
                    <img src="{{ asset('assets/about/waktu.jpg') }}" alt="Tepat Waktu" class="absolute inset-0 w-full h-full object-cover z-0 transition-transform duration-500 group-hover:scale-105">
                    <!-- Overlay Dark to ensure readability -->
                    <div class="absolute inset-0 bg-[#A0522D]/80 z-10 transition-opacity duration-300 group-hover:bg-[#A0522D]/85"></div>
                @else
                    <!-- Fallback Gradient matching mockup Card 2 (Warm brown/rust gradient) -->
                    <div class="absolute inset-0 bg-gradient-to-b from-[#b25b29] to-[#803a15] z-10"></div>
                @endif
                
                <!-- Card Content -->
                <div class="relative z-20 h-full flex flex-col items-center justify-center text-center p-8 transition-all duration-300">
                    <span class="absolute top-6 right-8 text-[44px] font-serif font-medium leading-none text-white/10 select-none">02</span>
                    
                    <h3 class="font-serif text-3xl font-medium text-white transition-all duration-300 group-hover:-translate-y-1">
                        Tepat Waktu
                    </h3>
                    
                    <!-- Reveal on Hover description -->
                    <p class="text-sm text-white/80 leading-relaxed max-w-[280px] mt-4 opacity-0 max-h-0 overflow-hidden transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:max-h-[140px] transform translate-y-4 group-hover:translate-y-0">
                        Setiap pengerjaan hardware, desain, maupun pencetakan memiliki estimasi waktu yang transparan dan selalu diselesaikan secara disiplin dan tepat waktu.
                    </p>
                </div>
            </div>

            <!-- Card 3: Pelayanan Ramah -->
            <div class="relative group overflow-hidden h-[340px] rounded-[24px] bg-[#FF8C00] shadow-lg transition-transform duration-300 hover:-translate-y-1">
                <!-- Image Tag (siap dimasukkan di public/assets/about/pelayanan.jpg) -->
                @if(file_exists(public_path('assets/about/pelayanan.jpg')))
                    <img src="{{ asset('assets/about/pelayanan.jpg') }}" alt="Pelayanan Ramah" class="absolute inset-0 w-full h-full object-cover z-0 transition-transform duration-500 group-hover:scale-105">
                    <!-- Overlay Dark to ensure readability -->
                    <div class="absolute inset-0 bg-[#FF8C00]/80 z-10 transition-opacity duration-300 group-hover:bg-[#FF8C00]/85"></div>
                @else
                    <!-- Fallback Gradient matching mockup Card 3 (Soft orange/salmon gradient) -->
                    <div class="absolute inset-0 bg-gradient-to-b from-[#ffa366] to-[#e66000] z-10"></div>
                @endif
                
                <!-- Card Content -->
                <div class="relative z-20 h-full flex flex-col items-center justify-center text-center p-8 transition-all duration-300">
                    <span class="absolute top-6 right-8 text-[44px] font-serif font-medium leading-none text-white/10 select-none">03</span>
                    
                    <h3 class="font-serif text-3xl font-medium text-white transition-all duration-300 group-hover:-translate-y-1">
                        Pelayanan Ramah
                    </h3>
                    
                    <!-- Reveal on Hover description -->
                    <p class="text-sm text-white/80 leading-relaxed max-w-[280px] mt-4 opacity-0 max-h-0 overflow-hidden transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:max-h-[140px] transform translate-y-4 group-hover:translate-y-0">
                        Tim ahli kami mengedepankan keramahan dalam melayani setiap sesi konsultasi untuk memberikan solusi terarah yang sesuai dengan budget Anda.
                    </p>
                </div>
            </div>

            <!-- Card 4: Unknown -->
            <div class="relative group overflow-hidden h-[340px] rounded-[24px] bg-[#A0522D] shadow-lg transition-transform duration-300 hover:-translate-y-1">
                <!-- Image Tag (siap dimasukkan di public/assets/about/waktu.jpg) -->
                @if(file_exists(public_path('assets/about/waktu.jpg')))
                    <img src="{{ asset('assets/about/waktu.jpg') }}" alt="Tepat Waktu" class="absolute inset-0 w-full h-full object-cover z-0 transition-transform duration-500 group-hover:scale-105">
                    <!-- Overlay Dark to ensure readability -->
                    <div class="absolute inset-0 bg-[#A0522D]/80 z-10 transition-opacity duration-300 group-hover:bg-[#A0522D]/85"></div>
                @else
                    <!-- Fallback Gradient matching mockup Card 2 (Warm brown/rust gradient) -->
                    <div class="absolute inset-0 bg-gradient-to-b from-[#b25b29] to-[#803a15] z-10"></div>
                @endif
                
                <!-- Card Content -->
                <div class="relative z-20 h-full flex flex-col items-center justify-center text-center p-8 transition-all duration-300">
                    <span class="absolute top-6 right-8 text-[44px] font-serif font-medium leading-none text-white/10 select-none">02</span>
                    
                    <h3 class="font-serif text-3xl font-medium text-white transition-all duration-300 group-hover:-translate-y-1">
                        Tepat Waktu
                    </h3>
                    
                    <!-- Reveal on Hover description -->
                    <p class="text-sm text-white/80 leading-relaxed max-w-[280px] mt-4 opacity-0 max-h-0 overflow-hidden transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:max-h-[140px] transform translate-y-4 group-hover:translate-y-0">
                        Setiap pengerjaan hardware, desain, maupun pencetakan memiliki estimasi waktu yang transparan dan selalu diselesaikan secara disiplin dan tepat waktu.
                    </p>
                </div>
            </div>

            <!-- Card 5: Unknown -->
            <div class="relative group overflow-hidden h-[340px] rounded-[24px] bg-[#A0522D] shadow-lg transition-transform duration-300 hover:-translate-y-1">
                <!-- Image Tag (siap dimasukkan di public/assets/about/waktu.jpg) -->
                @if(file_exists(public_path('assets/about/waktu.jpg')))
                    <img src="{{ asset('assets/about/waktu.jpg') }}" alt="Tepat Waktu" class="absolute inset-0 w-full h-full object-cover z-0 transition-transform duration-500 group-hover:scale-105">
                    <!-- Overlay Dark to ensure readability -->
                    <div class="absolute inset-0 bg-[#A0522D]/80 z-10 transition-opacity duration-300 group-hover:bg-[#A0522D]/85"></div>
                @else
                    <!-- Fallback Gradient matching mockup Card 2 (Warm brown/rust gradient) -->
                    <div class="absolute inset-0 bg-gradient-to-b from-[#b25b29] to-[#803a15] z-10"></div>
                @endif
                
                <!-- Card Content -->
                <div class="relative z-20 h-full flex flex-col items-center justify-center text-center p-8 transition-all duration-300">
                    <span class="absolute top-6 right-8 text-[44px] font-serif font-medium leading-none text-white/10 select-none">02</span>
                    
                    <h3 class="font-serif text-3xl font-medium text-white transition-all duration-300 group-hover:-translate-y-1">
                        Tepat Waktu
                    </h3>
                    
                    <!-- Reveal on Hover description -->
                    <p class="text-sm text-white/80 leading-relaxed max-w-[280px] mt-4 opacity-0 max-h-0 overflow-hidden transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:max-h-[140px] transform translate-y-4 group-hover:translate-y-0">
                        Setiap pengerjaan hardware, desain, maupun pencetakan memiliki estimasi waktu yang transparan dan selalu diselesaikan secara disiplin dan tepat waktu.
                    </p>
                </div>
            </div>

            <!-- Card 6: Unknown -->
            <div class="relative group overflow-hidden h-[340px] rounded-[24px] bg-[#A0522D] shadow-lg transition-transform duration-300 hover:-translate-y-1">
                <!-- Image Tag (siap dimasukkan di public/assets/about/waktu.jpg) -->
                @if(file_exists(public_path('assets/about/waktu.jpg')))
                    <img src="{{ asset('assets/about/waktu.jpg') }}" alt="Tepat Waktu" class="absolute inset-0 w-full h-full object-cover z-0 transition-transform duration-500 group-hover:scale-105">
                    <!-- Overlay Dark to ensure readability -->
                    <div class="absolute inset-0 bg-[#A0522D]/80 z-10 transition-opacity duration-300 group-hover:bg-[#A0522D]/85"></div>
                @else
                    <!-- Fallback Gradient matching mockup Card 2 (Warm brown/rust gradient) -->
                    <div class="absolute inset-0 bg-gradient-to-b from-[#b25b29] to-[#803a15] z-10"></div>
                @endif
                
                <!-- Card Content -->
                <div class="relative z-20 h-full flex flex-col items-center justify-center text-center p-8 transition-all duration-300">
                    <span class="absolute top-6 right-8 text-[44px] font-serif font-medium leading-none text-white/10 select-none">02</span>
                    
                    <h3 class="font-serif text-3xl font-medium text-white transition-all duration-300 group-hover:-translate-y-1">
                        Tepat Waktu
                    </h3>
                    
                    <!-- Reveal on Hover description -->
                    <p class="text-sm text-white/80 leading-relaxed max-w-[280px] mt-4 opacity-0 max-h-0 overflow-hidden transition-all duration-500 ease-in-out group-hover:opacity-100 group-hover:max-h-[140px] transform translate-y-4 group-hover:translate-y-0">
                        Setiap pengerjaan hardware, desain, maupun pencetakan memiliki estimasi waktu yang transparan dan selalu diselesaikan secara disiplin dan tepat waktu.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
