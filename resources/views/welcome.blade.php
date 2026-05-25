{{--
    welcome.blade.php
    -----------------
    File ini sudah dipecah menjadi komponen-komponen terstruktur.
    Halaman utama sekarang ada di: resources/views/pages/home.blade.php

    Struktur komponen:
    ├── components/layouts/app.blade.php   ← Layout utama (head, body wrapper)
    ├── components/navbar.blade.php        ← Navigasi & mobile menu
    ├── components/footer.blade.php        ← Footer
    ├── components/hero.blade.php          ← Section hero + stats
    ├── components/ticker.blade.php        ← Marquee ticker animasi
    ├── components/layanan.blade.php       ← 4 pilar layanan
    ├── components/nilai.blade.php         ← Nilai utama (dark section)
    ├── components/fitur.blade.php         ← 5 fitur website
    ├── components/tracking.blade.php      ← Order tracker interaktif
    └── components/cta.blade.php           ← Call to action
--}}

@include('pages.home')
