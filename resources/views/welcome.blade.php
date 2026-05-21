<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jogjatouch — Teknologi & Kreativitas Tanpa Batas</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

        <!-- Tailwind CSS v4 & JS Compilation -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Extra Custom Style for Ticker & Aesthetic Gradients -->
        <style>
            body {
                font-family: 'Instrument Sans', ui-sans-serif, system-ui, -apple-system, sans-serif;
                background-color: #FBF9F6;
            }
            .font-serif-display {
                font-family: 'Playfair Display', Georgia, serif;
            }
            
            /* Custom smooth marquee scroll animation */
            @keyframes marquee {
                0% { transform: translateX(0%); }
                100% { transform: translateX(-50%); }
            }
            .animate-marquee {
                display: flex;
                width: max-content;
                animation: marquee 25s linear infinite;
            }
            .animate-marquee:hover {
                animation-play-state: paused;
            }

            /* Custom abstract shape glowing backdrops */
            .bg-glow-orange {
                background: radial-gradient(circle, rgba(227,93,37,0.15) 0%, rgba(227,93,37,0) 70%);
            }
            .bg-glow-dark {
                background: radial-gradient(circle, rgba(227,93,37,0.2) 0%, rgba(25,22,21,0) 65%);
            }

            /* Glassmorphism utility */
            .glassmorphic-card {
                background: rgba(255, 255, 255, 0.03);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.08);
            }
        </style>
    </head>
    <body class="antialiased text-[#1E1B19] bg-[#FBF9F6] selection:bg-[#E35D25] selection:text-white overflow-x-hidden">

        <!-- SECTION 1: HEADER & NAVIGATION -->
        <header class="sticky top-0 z-50 w-full bg-[#FBF9F6]/85 backdrop-blur-md border-b border-[#1E1B19]/5">
            <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
                
                <!-- Logo -->
                <a href="#" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 rounded-xl bg-[#E35D25] flex items-center justify-center text-white font-bold text-xl shadow-md shadow-[#E35D25]/20 group-hover:scale-105 transition-transform duration-300">
                        J
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

        <!-- SECTION 2: HERO SECTION -->
        <section class="relative pt-12 pb-24 md:pt-20 md:pb-32 overflow-hidden">
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
                                    <div class="w-10 h-18 bg-[#E35D25] rounded-lg rotate-12 flex items-center justify-center font-bold text-white text-3xl shadow-lg shadow-[#E35D25]/30 mb-4 z-10">
                                        J
                                    </div>
                                    <!-- Vertical text inside smartphone mockup -->
                                    <div class="text-[10px] md:text-xs font-bold tracking-widest text-[#1E1B19]/70 uppercase z-10 flex flex-col items-center gap-1 font-serif-display italic">
                                        <span>J</span>
                                        <span>O</span>
                                        <span>G</span>
                                        <span>J</span>
                                        <span>A</span>
                                    </div>
                                    <div class="text-[9px] md:text-[10px] font-semibold text-[#E35D25] tracking-widest uppercase mt-1 z-10">
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

                <!-- SECTION 3: THREE STATS / METRICS GRID -->
                <div id="tentang" class="grid grid-cols-1 md:grid-cols-3 gap-12 pt-16 mt-20 border-t border-[#1E1B19]/10">
                    <!-- Stat 1 -->
                    <div class="flex flex-col items-start group">
                        <span class="font-serif-display text-4xl font-bold text-[#E35D25] mb-3 group-hover:scale-105 transition-transform duration-300">01</span>
                        <h3 class="text-lg font-bold text-[#1E1B19] mb-2">Kualitas Premium</h3>
                        <p class="text-sm text-[#1E1B19]/70 leading-relaxed">
                            Kami selalu menghadirkan layanan terbaik dengan material, komponen, dan standardisasi pengerjaan kelas premium untuk kenyamanan jangka panjang.
                        </p>
                    </div>
                    <!-- Stat 2 -->
                    <div class="flex flex-col items-start group">
                        <span class="font-serif-display text-4xl font-bold text-[#E35D25] mb-3 group-hover:scale-105 transition-transform duration-300">02</span>
                        <h3 class="text-lg font-bold text-[#1E1B19] mb-2">Tepat Waktu</h3>
                        <p class="text-sm text-[#1E1B19]/70 leading-relaxed">
                            Setiap pengerjaan hardware, desain, maupun pencetakan memiliki estimasi waktu yang transparan dan selalu diselesaikan secara disiplin dan tepat waktu.
                        </p>
                    </div>
                    <!-- Stat 3 -->
                    <div class="flex flex-col items-start group">
                        <span class="font-serif-display text-4xl font-bold text-[#E35D25] mb-3 group-hover:scale-105 transition-transform duration-300">03</span>
                        <h3 class="text-lg font-bold text-[#1E1B19] mb-2">Pelayanan Ramah</h3>
                        <p class="text-sm text-[#1E1B19]/70 leading-relaxed">
                            Tim ahli kami mengedepankan keramahan dalam melayani setiap sesi konsultasi untuk memberikan solusi terarah yang sesuai dengan budget Anda.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <!-- SECTION 4: ANIMATED TICKER (MARQUEE) -->
        <section class="bg-[#1E1B19] text-white py-6 overflow-hidden relative border-y border-white/5">
            <div class="w-full">
                <div class="animate-marquee whitespace-nowrap flex items-center gap-16 text-sm font-semibold uppercase tracking-widest select-none">
                    <span>Maintenance</span> <span class="text-[#E35D25]">•</span>
                    <span>Network Analysis</span> <span class="text-[#E35D25]">•</span>
                    <span>Design Grafis</span> <span class="text-[#E35D25]">•</span>
                    <span>Printing</span> <span class="text-[#E35D25]">•</span>
                    <span>Rakit PC</span> <span class="text-[#E35D25]">•</span>
                    <span>IT Consulting</span> <span class="text-[#E35D25]">•</span>
                    
                    <!-- Repeat for smooth scroll effect -->
                    <span>Maintenance</span> <span class="text-[#E35D25]">•</span>
                    <span>Network Analysis</span> <span class="text-[#E35D25]">•</span>
                    <span>Design Grafis</span> <span class="text-[#E35D25]">•</span>
                    <span>Printing</span> <span class="text-[#E35D25]">•</span>
                    <span>Rakit PC</span> <span class="text-[#E35D25]">•</span>
                    <span>IT Consulting</span> <span class="text-[#E35D25]">•</span>

                    <!-- Repeat for smooth scroll effect -->
                    <span>Maintenance</span> <span class="text-[#E35D25]">•</span>
                    <span>Network Analysis</span> <span class="text-[#E35D25]">•</span>
                    <span>Design Grafis</span> <span class="text-[#E35D25]">•</span>
                    <span>Printing</span> <span class="text-[#E35D25]">•</span>
                    <span>Rakit PC</span> <span class="text-[#E35D25]">•</span>
                    <span>IT Consulting</span> <span class="text-[#E35D25]">•</span>
                </div>
            </div>
        </section>

        <!-- SECTION 5: FOUR PILLARS SERVICES -->
        <section id="layanan" class="py-24 md:py-32 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                
                <!-- Section Title Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end mb-16">
                    <div class="lg:col-span-8">
                        <span class="text-xs font-bold text-[#E35D25] tracking-widest uppercase block mb-4">LAYANAN KAMI</span>
                        <h2 class="font-serif-display text-4xl md:text-5xl font-semibold tracking-tight text-[#1E1B19] leading-tight">
                            Empat pilar <span class="italic text-[#E35D25] font-serif-display">layanan</span><br>untuk kebutuhan Anda
                        </h2>
                    </div>
                    <div class="lg:col-span-4">
                        <p class="text-[#1E1B19]/70 leading-relaxed text-sm">
                            Kami merancang solusi menyeluruh yang mencakup aspek hardware fisik, perawatan berkala, aset visual kreatif, hingga hasil cetak berskala profesional.
                        </p>
                    </div>
                </div>

                <!-- 4 Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    <!-- Card 1: Hardware -->
                    <div class="bg-[#FBF9F6] border border-[#1E1B19]/5 rounded-2xl p-8 hover:-translate-y-1.5 transition-all duration-300 hover:shadow-xl hover:shadow-black/5 flex flex-col justify-between group h-80">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center text-[#E35D25] shadow-sm border border-[#1E1B19]/5 mb-6 group-hover:bg-[#E35D25] group-hover:text-white transition-colors duration-300">
                                <!-- CPU Icon -->
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 5h10a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-[#1E1B19] mb-3">Hardware & Rakit</h3>
                            <p class="text-sm text-[#1E1B19]/70 leading-relaxed">
                                Konsultasi dan perakitan PC custom (Gaming, Office, Rendering), upgrade komponen, serta instalasi hardware berkualitas.
                            </p>
                        </div>
                        <a href="#cta" class="inline-flex items-center text-xs font-bold text-[#E35D25] hover:text-[#1E1B19] uppercase tracking-wider mt-6 group/btn">
                            Hubungi Tim
                            <svg class="w-4 h-4 ml-1.5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <!-- Card 2: Maintenance -->
                    <div class="bg-[#FBF9F6] border border-[#1E1B19]/5 rounded-2xl p-8 hover:-translate-y-1.5 transition-all duration-300 hover:shadow-xl hover:shadow-black/5 flex flex-col justify-between group h-80">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center text-[#E35D25] shadow-sm border border-[#1E1B19]/5 mb-6 group-hover:bg-[#E35D25] group-hover:text-white transition-colors duration-300">
                                <!-- Wrench Icon -->
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-[#1E1B19] mb-3">Maintenance</h3>
                            <p class="text-sm text-[#1E1B19]/70 leading-relaxed">
                                Pembersihan hardware secara berkala, penggantian thermal paste premium, optimasi software, dan troubleshooting kendala sistem.
                            </p>
                        </div>
                        <a href="#cta" class="inline-flex items-center text-xs font-bold text-[#E35D25] hover:text-[#1E1B19] uppercase tracking-wider mt-6 group/btn">
                            Konsultasi
                            <svg class="w-4 h-4 ml-1.5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <!-- Card 3: Design -->
                    <div class="bg-[#FBF9F6] border border-[#1E1B19]/5 rounded-2xl p-8 hover:-translate-y-1.5 transition-all duration-300 hover:shadow-xl hover:shadow-black/5 flex flex-col justify-between group h-80">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center text-[#E35D25] shadow-sm border border-[#1E1B19]/5 mb-6 group-hover:bg-[#E35D25] group-hover:text-white transition-colors duration-300">
                                <!-- Palette Icon -->
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-[#1E1B19] mb-3">Design</h3>
                            <p class="text-sm text-[#1E1B19]/70 leading-relaxed">
                                Jasa desain grafis kustom seperti branding logo, media sosial, poster, banner promosi, hingga interface visual berkarakter modern.
                            </p>
                        </div>
                        <a href="#cta" class="inline-flex items-center text-xs font-bold text-[#E35D25] hover:text-[#1E1B19] uppercase tracking-wider mt-6 group/btn">
                            Lihat Katalog
                            <svg class="w-4 h-4 ml-1.5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <!-- Card 4: Printing -->
                    <div class="bg-[#FBF9F6] border border-[#1E1B19]/5 rounded-2xl p-8 hover:-translate-y-1.5 transition-all duration-300 hover:shadow-xl hover:shadow-black/5 flex flex-col justify-between group h-80">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center text-[#E35D25] shadow-sm border border-[#1E1B19]/5 mb-6 group-hover:bg-[#E35D25] group-hover:text-white transition-colors duration-300">
                                <!-- Printer Icon -->
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-[#1E1B19] mb-3">Printing</h3>
                            <p class="text-sm text-[#1E1B19]/70 leading-relaxed">
                                Pencetakan berkualitas premium untuk brosur, id card, spanduk, stiker kustom, dokumen perusahaan, dan merchendise presisi tinggi.
                            </p>
                        </div>
                        <a href="#cta" class="inline-flex items-center text-xs font-bold text-[#E35D25] hover:text-[#1E1B19] uppercase tracking-wider mt-6 group/btn">
                            Cetak Sekarang
                            <svg class="w-4 h-4 ml-1.5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                </div>

            </div>
        </section>

        <!-- SECTION 6: VALUES DARK SECTION -->
        <section class="relative bg-[#1A1816] text-white py-24 md:py-32 overflow-hidden">
            <!-- Glow background effect -->
            <div class="absolute -bottom-40 left-0 w-[500px] h-[500px] bg-glow-dark pointer-events-none rounded-full"></div>
            
            <div class="max-w-7xl mx-auto px-6 relative z-10">
                
                <!-- Tagline & Heading -->
                <div class="max-w-3xl mb-16">
                    <span class="text-xs font-bold text-[#E35D25] tracking-widest uppercase block mb-4">NILAI UTAMA</span>
                    <h2 class="font-serif-display text-4xl md:text-5xl font-semibold tracking-tight leading-tight">
                        Bukan tentang <span class="italic text-[#E35D25] font-serif-display">angka besar</span> —<br>tentang pekerjaan yang <span class="italic text-[#E35D25] font-serif-display">dikerjakan dengan benar</span>
                    </h2>
                </div>

                <!-- 4 Columns of Values -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Value 1 -->
                    <div class="glassmorphic-card rounded-2xl p-6 hover:bg-white/5 transition-colors duration-300">
                        <div class="w-10 h-10 rounded-lg bg-[#E35D25]/15 text-[#E35D25] flex items-center justify-center mb-6">
                            <!-- Lightning Bolt -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Respon Cepat</h3>
                        <p class="text-sm text-white/60 leading-relaxed">
                            Kami mengedepankan respon yang tanggap agar perbaikan sistem Anda tidak tertunda lama.
                        </p>
                    </div>

                    <!-- Value 2 -->
                    <div class="glassmorphic-card rounded-2xl p-6 hover:bg-white/5 transition-colors duration-300">
                        <div class="w-10 h-10 rounded-lg bg-[#E35D25]/15 text-[#E35D25] flex items-center justify-center mb-6">
                            <!-- Shield Check -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Garansi Pengerjaan</h3>
                        <p class="text-sm text-white/60 leading-relaxed">
                            Semua perakitan, maintenance, dan cetak produk kami garansi penuh demi kenyamanan Anda.
                        </p>
                    </div>

                    <!-- Value 3 -->
                    <div class="glassmorphic-card rounded-2xl p-6 hover:bg-white/5 transition-colors duration-300">
                        <div class="w-10 h-10 rounded-lg bg-[#E35D25]/15 text-[#E35D25] flex items-center justify-center mb-6">
                            <!-- Currency Dollar -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Transparansi Biaya</h3>
                        <p class="text-sm text-white/60 leading-relaxed">
                            Penawaran harga yang jujur di awal tanpa tambahan biaya tersembunyi yang meragukan.
                        </p>
                    </div>

                    <!-- Value 4 -->
                    <div class="glassmorphic-card rounded-2xl p-6 hover:bg-white/5 transition-colors duration-300">
                        <div class="w-10 h-10 rounded-lg bg-[#E35D25]/15 text-[#E35D25] flex items-center justify-center mb-6">
                            <!-- Academic Cap -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Teknisi Profesional</h3>
                        <p class="text-sm text-white/60 leading-relaxed">
                            Project Anda dikerjakan langsung oleh tim terampil berpengalaman dan bersertifikat resmi.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <!-- SECTION 7: EXPLORE FEATURES -->
        <section id="fitur" class="py-24 bg-[#FBF9F6]">
            <div class="max-w-7xl mx-auto px-6">
                
                <!-- Section title -->
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-4">
                    <div>
                        <span class="text-xs font-bold text-[#E35D25] tracking-widest uppercase block mb-4">FITUR TERBAIK</span>
                        <h2 class="font-serif-display text-4xl md:text-5xl font-semibold tracking-tight text-[#1E1B19] leading-none">
                            Jelajahi <span class="italic text-[#E35D25] font-serif-display">fitur website</span> kami.
                        </h2>
                    </div>
                    <div>
                        <p class="text-sm text-[#1E1B19]/70 max-w-sm">
                            Platform interaktif kami dirancang khusus agar Anda dapat merasakan kemudahan akses informasi dari mana saja.
                        </p>
                    </div>
                </div>

                <!-- 5 Card Horizontal Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- Feature 1 -->
                    <div class="bg-white border border-[#1E1B19]/5 rounded-xl p-6 hover:shadow-md transition-shadow duration-300 group">
                        <span class="text-[10px] uppercase font-extrabold tracking-widest text-[#E35D25] mb-2 block">Fitur 01</span>
                        <h3 class="text-base font-bold text-[#1E1B19] mb-1 group-hover:text-[#E35D25] transition-colors">Profil</h3>
                        <p class="text-xs text-[#1E1B19]/65">Informasi lengkap, visi, misi, dan tim profesional Jogjatouch.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white border border-[#1E1B19]/5 rounded-xl p-6 hover:shadow-md transition-shadow duration-300 group">
                        <span class="text-[10px] uppercase font-extrabold tracking-widest text-[#E35D25] mb-2 block">Fitur 02</span>
                        <h3 class="text-base font-bold text-[#1E1B19] mb-1 group-hover:text-[#E35D25] transition-colors">Tracking order</h3>
                        <p class="text-xs text-[#1E1B19]/65">Pantau status pengerjaan secara real-time langsung melalui web.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white border border-[#1E1B19]/5 rounded-xl p-6 hover:shadow-md transition-shadow duration-300 group">
                        <span class="text-[10px] uppercase font-extrabold tracking-widest text-[#E35D25] mb-2 block">Fitur 03</span>
                        <h3 class="text-base font-bold text-[#1E1B19] mb-1 group-hover:text-[#E35D25] transition-colors">Portofolio</h3>
                        <p class="text-xs text-[#1E1B19]/65">Kumpulan hasil proyek, testimoni client, dan galeri pengerjaan.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-white border border-[#1E1B19]/5 rounded-xl p-6 hover:shadow-md transition-shadow duration-300 group">
                        <span class="text-[10px] uppercase font-extrabold tracking-widest text-[#E35D25] mb-2 block">Fitur 04</span>
                        <h3 class="text-base font-bold text-[#1E1B19] mb-1 group-hover:text-[#E35D25] transition-colors">Katalog Produk</h3>
                        <p class="text-xs text-[#1E1B19]/65">Pilihan hardware PC terbaru dan paket layanan kreatif hemat.</p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="bg-white border border-[#1E1B19]/5 rounded-xl p-6 hover:shadow-md transition-shadow duration-300 group">
                        <span class="text-[10px] uppercase font-extrabold tracking-widest text-[#E35D25] mb-2 block">Fitur 05</span>
                        <h3 class="text-base font-bold text-[#1E1B19] mb-1 group-hover:text-[#E35D25] transition-colors">FAQ & Support</h3>
                        <p class="text-xs text-[#1E1B19]/65">Bantuan 24 jam dan kumpulan jawaban atas pertanyaan umum.</p>
                    </div>
                </div>

            </div>
        </section>

        <!-- SECTION 8: INTERACTIVE ORDER STATUS TRACKER -->
        <section id="tracking" class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                
                <!-- Heading -->
                <div class="text-center max-w-xl mx-auto mb-16">
                    <span class="text-xs font-bold text-[#E35D25] tracking-widest uppercase block mb-4">PELACAKAN REAL-TIME</span>
                    <h2 class="font-serif-display text-4xl md:text-5xl font-semibold tracking-tight text-[#1E1B19] mb-4">
                        Cek <span class="italic text-[#E35D25] font-serif-display">status pesanan</span> Anda.
                    </h2>
                    <p class="text-sm text-[#1E1B19]/70">
                        Gunakan kolom interaktif di bawah untuk melacak kemajuan pengerjaan PC rakitan, desain, atau hasil cetak Anda secara real-time.
                    </p>
                </div>

                <!-- Tracker Widget Container -->
                <div class="max-w-2xl mx-auto bg-[#FBF9F6] border border-[#1E1B19]/5 rounded-3xl p-6 md:p-8 shadow-xl shadow-black/5">
                    
                    <!-- Search Input Bar -->
                    <div class="flex flex-col sm:flex-row gap-3 mb-8">
                        <div class="relative flex-1">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-[#1E1B19]/40" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input 
                                type="text" 
                                id="tracking-input" 
                                class="w-full pl-12 pr-4 py-4 rounded-full bg-white border border-[#1E1B19]/10 text-sm font-medium focus:outline-none focus:border-[#E35D25] focus:ring-1 focus:ring-[#E35D25] transition-all" 
                                placeholder="Masukkan kode tracking pesanan... (Contoh: TJ-2026-0412)"
                                value="TJ-2026-0412"
                            >
                        </div>
                        <button 
                            id="tracking-search-btn"
                            class="px-8 py-4 rounded-full bg-[#1E1B19] hover:bg-[#332e2c] text-white font-semibold text-sm transition-colors duration-200 active:scale-98"
                        >
                            Cek Status
                        </button>
                    </div>

                    <!-- Dynamic Results Output Box -->
                    <div id="tracker-result-box" class="transition-all duration-300 opacity-100">
                        <!-- Active Tracking Detail Card -->
                        <div class="bg-white border border-[#1E1B19]/5 rounded-2xl p-6 md:p-8 shadow-sm">
                            
                            <!-- Header Info -->
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 pb-6 border-b border-[#1E1B19]/5 mb-6">
                                <div>
                                    <span class="text-xs font-semibold text-[#1E1B19]/55 block uppercase tracking-wider">Nomor Pesanan</span>
                                    <h3 id="result-order-id" class="text-lg font-extrabold text-[#1E1B19] tracking-tight">TJ-2026-0412</h3>
                                </div>
                                <div class="px-4 py-1.5 rounded-full text-xs font-bold text-[#E35D25] bg-[#E35D25]/10 border border-[#E35D25]/20 uppercase tracking-wider" id="result-status-badge">
                                    Proses Pengerjaan
                                </div>
                            </div>

                            <!-- Visual Step Progress Tracker -->
                            <div class="relative py-8 mb-6">
                                <!-- Background Line -->
                                <div class="absolute top-[37px] left-8 right-8 h-1 bg-[#1E1B19]/5 rounded-full z-0"></div>
                                
                                <!-- Active Fill Line -->
                                <div id="tracker-progress-line" class="absolute top-[37px] left-8 h-1 bg-[#E35D25] rounded-full z-0 transition-all duration-700" style="width: 33.33%;"></div>

                                <!-- Stepper Step Elements -->
                                <div class="relative z-10 flex justify-between">
                                    
                                    <!-- Step 1: Diterima -->
                                    <div class="flex flex-col items-center">
                                        <div id="step-dot-1" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-[#E35D25] text-white shadow-md border-2 border-white transition-all duration-500">
                                            ✓
                                        </div>
                                        <span class="text-[11px] font-bold text-[#1E1B19] mt-3">Diterima</span>
                                    </div>

                                    <!-- Step 2: Proses Pengerjaan -->
                                    <div class="flex flex-col items-center">
                                        <div id="step-dot-2" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-[#E35D25] text-white shadow-md border-2 border-white transition-all duration-500">
                                            2
                                        </div>
                                        <span class="text-[11px] font-bold text-[#1E1B19] mt-3">Pengerjaan</span>
                                    </div>

                                    <!-- Step 3: Selesai -->
                                    <div class="flex flex-col items-center">
                                        <div id="step-dot-3" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-[#1E1B19]/10 text-[#1E1B19]/40 border-2 border-white transition-all duration-500">
                                            3
                                        </div>
                                        <span class="text-[11px] font-semibold text-[#1E1B19]/40 mt-3">Selesai</span>
                                    </div>

                                    <!-- Step 4: Diambil -->
                                    <div class="flex flex-col items-center">
                                        <div id="step-dot-4" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs bg-[#1E1B19]/10 text-[#1E1B19]/40 border-2 border-white transition-all duration-500">
                                            4
                                        </div>
                                        <span class="text-[11px] font-semibold text-[#1E1B19]/40 mt-3">Diambil</span>
                                    </div>

                                </div>
                            </div>

                            <!-- Status Description Footer Text -->
                            <div class="bg-[#FBF9F6] border border-[#1E1B19]/5 rounded-xl p-4 flex gap-3 items-start mt-6">
                                <svg class="w-5 h-5 text-[#E35D25] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div class="text-xs text-[#1E1B19]/75 leading-relaxed">
                                    <span class="font-bold text-[#1E1B19] block mb-1">Pembaruan Terakhir:</span>
                                    <p id="result-status-text">PC Gaming Custom sedang dirakit dan diuji oleh teknisi senior kami. Kabel manajemen rapi dan instalasi driver terbaru berjalan normal.</p>
                                    <span class="text-[10px] text-[#1E1B19]/50 block mt-2" id="result-time-text">Pembaruan: 20 Mei 2026, 15:45 WIB</span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- SECTION 9: CALL TO ACTION (CTA) -->
        <section id="cta" class="py-24 bg-[#FBF9F6]">
            <div class="max-w-6xl mx-auto px-6">
                <div class="relative bg-[#1A1816] text-white rounded-3xl p-8 md:p-16 overflow-hidden shadow-2xl flex flex-col lg:flex-row items-center justify-between gap-8">
                    <!-- Glowing circular background decor inside CTA -->
                    <div class="absolute -right-20 -bottom-20 w-[400px] h-[400px] bg-glow-dark pointer-events-none rounded-full"></div>
                    
                    <div class="relative z-10 max-w-xl text-center lg:text-left">
                        <span class="text-xs font-bold text-[#E35D25] tracking-widest uppercase block mb-3">MULAI HARI INI</span>
                        <h2 class="font-serif-display text-4xl md:text-5xl font-semibold tracking-tight leading-tight mb-4">
                            Siap memulai<br><span class="italic text-[#E35D25] font-serif-display">proyek Anda?</span>
                        </h2>
                        <p class="text-sm text-white/70 leading-relaxed">
                            Hubungi tim ahli Jogjatouch hari ini untuk konsultasi gratis mengenai perakitan PC, maintenance sistem, jasa desain grafis, atau kebutuhan cetak berkualitas premium Anda.
                        </p>
                    </div>

                    <div class="relative z-10 flex flex-col sm:flex-row gap-4 w-full sm:w-auto shrink-0">
                        <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center justify-center px-8 py-4 rounded-full text-base font-semibold bg-[#E35D25] text-white hover:bg-[#c74c1a] hover:-translate-y-0.5 active:translate-y-0 transition-all shadow-lg shadow-[#E35D25]/15">
                            Hubungi Whatsapp
                        </a>
                        <a href="#layanan" class="inline-flex items-center justify-center px-8 py-4 rounded-full text-base font-semibold border border-white/20 hover:bg-white/5 transition-all text-white">
                            Lihat Portofolio
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 10: DETAILED FOOTER -->
        <footer class="bg-[#131110] text-white pt-20 pb-10 border-t border-white/5">
            <div class="max-w-7xl mx-auto px-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 pb-16 border-b border-white/5 mb-12">
                    
                    <!-- Brand Column -->
                    <div class="lg:col-span-2 flex flex-col items-start">
                        <a href="#" class="flex items-center gap-2 group mb-6">
                            <div class="w-9 h-9 rounded-xl bg-[#E35D25] flex items-center justify-center text-white font-bold text-lg shadow-sm shadow-[#E35D25]/20 group-hover:scale-105 transition-transform duration-300">
                                J
                            </div>
                            <span class="font-serif-display font-bold text-lg tracking-tight">Jogja<span class="text-[#E35D25]">touch</span></span>
                        </a>
                        <p class="text-xs text-white/50 leading-relaxed mb-6 max-w-sm">
                            Jogjatouch adalah penyedia solusi hardware & perakitan PC, perawatan sistem komputer, desain kreatif digital, dan layanan cetak premium di Yogyakarta. Kami mengedepankan kualitas pengerjaan, transparansi biaya, dan keramahan pelayanan.
                        </p>
                        <!-- Social Media Links -->
                        <div class="flex gap-4">
                            <a href="#" class="w-8 h-8 rounded-full bg-white/5 hover:bg-[#E35D25] hover:text-white text-white/60 flex items-center justify-center transition-colors" aria-label="Instagram">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </a>
                            <a href="#" class="w-8 h-8 rounded-full bg-white/5 hover:bg-[#E35D25] hover:text-white text-white/60 flex items-center justify-center transition-colors" aria-label="Facebook">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                            </a>
                            <a href="#" class="w-8 h-8 rounded-full bg-white/5 hover:bg-[#E35D25] hover:text-white text-white/60 flex items-center justify-center transition-colors" aria-label="Twitter">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Column 2: Layanan -->
                    <div class="flex flex-col items-start">
                        <h4 class="text-sm font-bold tracking-wider uppercase mb-6 text-white">Layanan</h4>
                        <ul class="space-y-3 text-xs text-white/60">
                            <li><a href="#layanan" class="hover:text-[#E35D25] transition-colors">Perakitan PC Custom</a></li>
                            <li><a href="#layanan" class="hover:text-[#E35D25] transition-colors">Maintenance & Perbaikan</a></li>
                            <li><a href="#layanan" class="hover:text-[#E35D25] transition-colors">Desain Grafis Kreatif</a></li>
                            <li><a href="#layanan" class="hover:text-[#E35D25] transition-colors">Cetak & Printing Premium</a></li>
                        </ul>
                    </div>

                    <!-- Column 3: Perusahaan -->
                    <div class="flex flex-col items-start">
                        <h4 class="text-sm font-bold tracking-wider uppercase mb-6 text-white">Perusahaan</h4>
                        <ul class="space-y-3 text-xs text-white/60">
                            <li><a href="#tentang" class="hover:text-[#E35D25] transition-colors">Tentang Kami</a></li>
                            <li><a href="#cta" class="hover:text-[#E35D25] transition-colors">Hubungi Kami</a></li>
                            <li><a href="#" class="hover:text-[#E35D25] transition-colors">Karir & Magang</a></li>
                            <li><a href="#" class="hover:text-[#E35D25] transition-colors">Syarat & Ketentuan</a></li>
                        </ul>
                    </div>

                    <!-- Column 4: Kontak Info -->
                    <div class="flex flex-col items-start">
                        <h4 class="text-sm font-bold tracking-wider uppercase mb-6 text-white">Kontak Kami</h4>
                        <ul class="space-y-3 text-xs text-white/60">
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-[#E35D25] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span>info@jogjatouch.com</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-[#E35D25] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 00.996.823h.005a1 1 0 00.996-.823l.548-2.2A1 1 0 0113.28 3H16.5a2 2 0 012 2v13.5a2 2 0 01-2 2h-3.28a1 1 0 01-.94-.725l-.548-2.2a1 1 0 00-.996-.823h-.005a1 1 0 00-.996.823l-.548 2.2a1 1 0 01-.94.725H5a2 2 0 01-2-2V5z"/></svg>
                                <span>+62 812-3456-7890</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-[#E35D25] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Sleman, D.I. Yogyakarta, Indonesia</span>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="flex flex-col sm:flex-row items-center justify-between text-xs text-white/40 gap-4">
                    <span>&copy; 2026 Jogjatouch. All rights reserved.</span>
                    <div class="flex gap-6">
                        <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                        <a href="#" class="hover:text-white transition-colors">Cookie Policy</a>
                    </div>
                </div>

            </div>
        </footer>

        <!-- INTERACTIVE LOGIC FOR TRACKER & MOBILE NAVIGATION -->
        <script>
            // 1. Mobile Menu Open/Close Drawer Toggle
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

            // 2. Interactive Order Status Tracker Search Database
            const trackingData = {
                'TJ-2026-0412': {
                    orderId: 'TJ-2026-0412',
                    status: 'Proses Pengerjaan',
                    progress: '33.33%',
                    step: 2,
                    text: 'PC Gaming Custom sedang dirakit dan diuji oleh teknisi senior kami. Kabel manajemen rapi dan instalasi driver terbaru berjalan normal.',
                    time: 'Pembaruan terakhir: 20 Mei 2026, 15:45 WIB'
                },
                'TJ-2026-0500': {
                    orderId: 'TJ-2026-0500',
                    status: 'Diterima',
                    progress: '0%',
                    step: 1,
                    text: 'Pesanan Anda (Jasa Desain Logo Branding) telah kami terima. Kami sedang melakukan analisis brand guide awal sebelum mulai merancang draf.',
                    time: 'Pembaruan terakhir: 20 Mei 2026, 09:12 WIB'
                },
                'TJ-2026-0390': {
                    orderId: 'TJ-2026-0390',
                    status: 'Selesai Pengerjaan',
                    progress: '66.66%',
                    step: 3,
                    text: 'Pengerjaan cetak spanduk promosi dan id card panitia telah selesai dengan kualitas warna yang tajam. Saat ini masuk tahap pengepakan rapi.',
                    time: 'Pembaruan terakhir: 19 Mei 2026, 17:30 WIB'
                },
                'TJ-2026-0350': {
                    orderId: 'TJ-2026-0350',
                    status: 'Sudah Diambil',
                    progress: '100%',
                    step: 4,
                    text: 'Pesanan PC Office Rakitan & Upgrade SSD Laptop telah selesai dikerjakan dan sudah diambil oleh pemilik pada tanggal 18 Mei 2026. Garansi berlaku 3 bulan.',
                    time: 'Pembaruan terakhir: 18 Mei 2026, 11:20 WIB'
                }
            };

            const searchInput = document.getElementById('tracking-input');
            const searchBtn = document.getElementById('tracking-search-btn');
            const resultBox = document.getElementById('tracker-result-box');

            searchBtn.addEventListener('click', performSearch);
            searchInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    performSearch();
                }
            });

            function performSearch() {
                const code = searchInput.value.trim().toUpperCase();
                
                // Add search transition effects
                resultBox.style.opacity = '0';
                
                setTimeout(() => {
                    if (trackingData[code]) {
                        const data = trackingData[code];
                        
                        // Populate results dynamically
                        resultBox.innerHTML = `
                            <div class="bg-white border border-[#1E1B19]/5 rounded-2xl p-6 md:p-8 shadow-sm">
                                
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 pb-6 border-b border-[#1E1B19]/5 mb-6">
                                    <div>
                                        <span class="text-xs font-semibold text-[#1E1B19]/55 block uppercase tracking-wider">Nomor Pesanan</span>
                                        <h3 id="result-order-id" class="text-lg font-extrabold text-[#1E1B19] tracking-tight">${data.orderId}</h3>
                                    </div>
                                    <div class="px-4 py-1.5 rounded-full text-xs font-bold text-[#E35D25] bg-[#E35D25]/10 border border-[#E35D25]/20 uppercase tracking-wider" id="result-status-badge">
                                        ${data.status}
                                    </div>
                                </div>

                                <div class="relative py-8 mb-6">
                                    <div class="absolute top-[37px] left-8 right-8 h-1 bg-[#1E1B19]/5 rounded-full z-0"></div>
                                    <div id="tracker-progress-line" class="absolute top-[37px] left-8 h-1 bg-[#E35D25] rounded-full z-0 transition-all duration-700" style="width: ${data.progress};"></div>

                                    <div class="relative z-10 flex justify-between">
                                        <div class="flex flex-col items-center">
                                            <div id="step-dot-1" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs ${data.step >= 1 ? 'bg-[#E35D25] text-white shadow-md border-2 border-white' : 'bg-[#1E1B19]/10 text-[#1E1B19]/40 border-2 border-white'} transition-all duration-500">
                                                ${data.step > 1 ? '✓' : '1'}
                                            </div>
                                            <span class="text-[11px] ${data.step >= 1 ? 'font-bold text-[#1E1B19]' : 'font-semibold text-[#1E1B19]/40'} mt-3">Diterima</span>
                                        </div>

                                        <div class="flex flex-col items-center">
                                            <div id="step-dot-2" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs ${data.step >= 2 ? 'bg-[#E35D25] text-white shadow-md border-2 border-white' : 'bg-[#1E1B19]/10 text-[#1E1B19]/40 border-2 border-white'} transition-all duration-500">
                                                ${data.step > 2 ? '✓' : '2'}
                                            </div>
                                            <span class="text-[11px] ${data.step >= 2 ? 'font-bold text-[#1E1B19]' : 'font-semibold text-[#1E1B19]/40'} mt-3">Pengerjaan</span>
                                        </div>

                                        <div class="flex flex-col items-center">
                                            <div id="step-dot-3" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs ${data.step >= 3 ? 'bg-[#E35D25] text-white shadow-md border-2 border-white' : 'bg-[#1E1B19]/10 text-[#1E1B19]/40 border-2 border-white'} transition-all duration-500">
                                                ${data.step > 3 ? '✓' : '3'}
                                            </div>
                                            <span class="text-[11px] ${data.step >= 3 ? 'font-bold text-[#1E1B19]' : 'font-semibold text-[#1E1B19]/40'} mt-3">Selesai</span>
                                        </div>

                                        <div class="flex flex-col items-center">
                                            <div id="step-dot-4" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs ${data.step >= 4 ? 'bg-[#E35D25] text-white shadow-md border-2 border-white' : 'bg-[#1E1B19]/10 text-[#1E1B19]/40 border-2 border-white'} transition-all duration-500">
                                                4
                                            </div>
                                            <span class="text-[11px] ${data.step >= 4 ? 'font-bold text-[#1E1B19]' : 'font-semibold text-[#1E1B19]/40'} mt-3">Diambil</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-[#FBF9F6] border border-[#1E1B19]/5 rounded-xl p-4 flex gap-3 items-start mt-6">
                                    <svg class="w-5 h-5 text-[#E35D25] shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div class="text-xs text-[#1E1B19]/75 leading-relaxed">
                                        <span class="font-bold text-[#1E1B19] block mb-1">Pembaruan Terakhir:</span>
                                        <p id="result-status-text">${data.text}</p>
                                        <span class="text-[10px] text-[#1E1B19]/50 block mt-2" id="result-time-text">${data.time}</span>
                                    </div>
                                </div>

                            </div>
                        `;
                    } else {
                        // Not Found State
                        resultBox.innerHTML = `
                            <div class="bg-red-50/50 border border-red-200/50 rounded-2xl p-8 text-center flex flex-col items-center justify-center">
                                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center text-red-600 mb-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-red-900 mb-1">Kode Pesanan Tidak Ditemukan</h3>
                                <p class="text-xs text-red-700/80 max-w-sm mb-4">
                                    Mohon periksa kembali kode tracking yang Anda masukkan. Pastikan sesuai dengan kode yang tertera pada nota transaksi Anda.
                                </p>
                                <div class="text-[10px] bg-red-100/50 text-red-800 px-3 py-1 rounded-md font-semibold font-mono">
                                    Contoh valid: TJ-2026-0412, TJ-2026-0500, TJ-2026-0390
                                </div>
                            </div>
                        `;
                    }
                    resultBox.style.opacity = '1';
                }, 300);
            }
        </script>
    </body>
</html>
