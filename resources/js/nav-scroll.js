export function initScrollSpy() {
    const navPills = Array.from(document.querySelectorAll('.nav-pill'));

    // Kelas active & inactive untuk pill desktop
    const activeClasses   = ['bg-[#1E1B19]', 'text-white', 'shadow-sm'];
    const inactiveClasses = ['text-[#1E1B19]/70', 'hover:text-[#1E1B19]', 'hover:bg-white/60'];

    // Ambil tinggi header untuk offset scroll
    const getHeaderHeight = () => {
        const header = document.querySelector('header.sticky');
        return header ? header.offsetHeight + 16 : 96;
    };

    // Kumpulkan semua section target dari href nav-pill yang pakai '#'
    const sectionIds = navPills
        .map(pill => pill.getAttribute('href'))
        .filter(href => href && href.startsWith('#'))
        .map(href => href.slice(1))
        .filter((id, index, arr) => arr.indexOf(id) === index); // unik

    const sections = sectionIds
        .map(id => document.getElementById(id))
        .filter(Boolean);

    if (!navPills.length || !sections.length) return;

    // Terapkan scroll-margin-top ke semua section agar tidak tertutup navbar
    const applyScrollMargin = () => {
        const offset = getHeaderHeight();
        sections.forEach(section => {
            section.style.scrollMarginTop = `${offset}px`;
        });
    };

    // Aktifkan pill berdasarkan id section
    const makeActive = (id) => {
        navPills.forEach(pill => {
            const href = pill.getAttribute('href');
            pill.classList.remove(...activeClasses, ...inactiveClasses);

            if (href === `#${id}`) {
                pill.classList.add(...activeClasses);
            } else {
                pill.classList.add(...inactiveClasses);
            }
        });
    };

    // ── Klik: smooth scroll ke section & langsung aktifkan pill ──────────────
    navPills.forEach(pill => {
        pill.addEventListener('click', (event) => {
            const href = pill.getAttribute('href');
            if (!href?.startsWith('#')) return;

            event.preventDefault();
            const target = document.getElementById(href.slice(1));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
            makeActive(href.slice(1));
        });
    });

    // ── Scroll spy: IntersectionObserver auto-highlight saat scroll ───────────
    let lastActiveId = sectionIds[0]; // default beranda aktif pertama

    const observerOptions = {
        root: null,
        // Trigger saat section masuk 20% dari atas viewport
        rootMargin: `-${getHeaderHeight()}px 0px -60% 0px`,
        threshold: 0,
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                lastActiveId = entry.target.id;
                makeActive(lastActiveId);
            }
        });
    }, observerOptions);

    sections.forEach(section => observer.observe(section));

    // Fallback: jika scroll ke paling bawah, aktifkan section terakhir
    window.addEventListener('scroll', () => {
        const scrollBottom = window.scrollY + window.innerHeight;
        const pageHeight   = document.documentElement.scrollHeight;

        if (scrollBottom >= pageHeight - 10) {
            makeActive(sectionIds[sectionIds.length - 1]);
            return;
        }

        // Jika scroll ke paling atas, aktifkan beranda
        if (window.scrollY < getHeaderHeight()) {
            makeActive(sectionIds[0]);
        }
    }, { passive: true });

    // Resize: perbarui scroll-margin dan re-observe
    window.addEventListener('resize', () => {
        applyScrollMargin();
    }, { passive: true });

    // Inisialisasi awal
    applyScrollMargin();
    makeActive(sectionIds[0]); // beranda aktif saat halaman pertama dibuka
}