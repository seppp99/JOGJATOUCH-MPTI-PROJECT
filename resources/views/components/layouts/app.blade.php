<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ?? 'Jogjatouch — Teknologi & Kreativitas Tanpa Batas' }}</title>

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

        {{ $head ?? '' }}
    </head>
    <body class="antialiased text-[#1E1B19] bg-[#FBF9F6] selection:bg-[#E35D25] selection:text-white overflow-x-hidden">

        <!-- NAVBAR -->
        <x-navbar />

        <!-- PAGE CONTENT -->
        {{ $slot }}

        <!-- FOOTER -->
        <x-footer />

        <!-- SCRIPTS -->
        @stack('scripts')

    </body>
</html>
