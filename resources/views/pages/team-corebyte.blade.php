<x-layouts.app>
    <x-slot name="title">Team Corebyte — Portofolio Tim</x-slot>

    <style>
        /* ===== COREBYTE THEME ===== */
        :root {
            --cb-navy:       #0D1B2A;
            --cb-navy-mid:   #122236;
            --cb-navy-light: #1a3050;
            --cb-gold:       #F4C430;
            --cb-gold-light: #ffe066;
            --cb-gold-dim:   rgba(244,196,48,0.15);
            --cb-gold-glow:  rgba(244,196,48,0.35);
        }

        .cb-page {
            background: var(--cb-navy);
            color: #e8eaf0;
            font-family: 'Instrument Sans', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== PARTICLE GRID BACKGROUND WITH INTERACTIVE CANVAS ===== */
        .cb-bg-grid {
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle, rgba(244,196,48,0.06) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
            z-index: 1;
        }

        #cb-network-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .cb-bg-glow-1 {
            position: absolute;
            top: -180px; left: -180px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(244,196,48,0.12) 0%, transparent 70%);
            pointer-events: none;
        }
        .cb-bg-glow-2 {
            position: absolute;
            bottom: -100px; right: -100px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(244,196,48,0.10) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ===== HERO ===== */
        .cb-hero {
            position: relative;
            padding: 100px 24px 80px;
            text-align: center;
            overflow: hidden;
            background: linear-gradient(180deg, #0a1520 0%, var(--cb-navy) 100%);
        }

        /* Orbital ring inspired by Corebyte logo */
        .cb-orbit-wrap {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 0;
        }
        .cb-orbit {
            width: 520px; height: 520px;
            border-radius: 50%;
            border: 1.5px solid rgba(244,196,48,0.15);
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            animation: cb-spin 18s linear infinite;
        }
        .cb-orbit::before {
            content: '';
            position: absolute;
            top: -5px; left: 50%;
            transform: translateX(-50%);
            width: 10px; height: 10px;
            background: var(--cb-gold);
            border-radius: 50%;
            box-shadow: 0 0 12px var(--cb-gold), 0 0 24px var(--cb-gold);
        }
        .cb-orbit-2 {
            width: 380px; height: 380px;
            animation-duration: 12s;
            animation-direction: reverse;
            border-color: rgba(244,196,48,0.10);
        }
        .cb-orbit-2::before {
            top: auto; bottom: -5px;
            width: 7px; height: 7px;
        }
        .cb-orbit-3 {
            width: 650px; height: 650px;
            animation-duration: 28s;
            border-color: rgba(244,196,48,0.06);
        }
        .cb-orbit-3::before { display: none; }

        @keyframes cb-spin {
            from { transform: translate(-50%, -50%) rotate(0deg); }
            to   { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .cb-hero-inner {
            position: relative;
            z-index: 2;
        }

        .cb-logo-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(244,196,48,0.08);
            border: 1px solid rgba(244,196,48,0.25);
            border-radius: 999px;
            padding: 8px 20px;
            font-size: 13px;
            font-weight: 600;
            color: var(--cb-gold);
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 28px;
        }
        .cb-logo-badge span.dot {
            width: 8px; height: 8px;
            background: var(--cb-gold);
            border-radius: 50%;
            box-shadow: 0 0 8px var(--cb-gold);
            animation: pulse-gold 2s ease-in-out infinite;
        }
        @keyframes pulse-gold {
            0%,100% { opacity: 1; transform: scale(1); }
            50%      { opacity: 0.5; transform: scale(1.4); }
        }

        .cb-hero-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: clamp(2.8rem, 7vw, 5.5rem);
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 20px;
            color: #ffffff;
        }
        .cb-hero-title .gold { color: var(--cb-gold); }

        .cb-hero-sub {
            font-size: clamp(1rem, 2.5vw, 1.2rem);
            color: rgba(232,234,240,0.65);
            max-width: 580px;
            margin: 0 auto 48px;
            line-height: 1.7;
        }

        /* Decorative divider */
        .cb-divider {
            display: flex;
            align-items: center;
            gap: 16px;
            max-width: 300px;
            margin: 0 auto 72px;
        }
        .cb-divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(244,196,48,0.4), transparent);
        }
        .cb-divider-icon {
            width: 28px; height: 28px;
            border: 1.5px solid rgba(244,196,48,0.4);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }
        .cb-divider-icon svg { width: 12px; height: 12px; color: var(--cb-gold); }

        /* ===== SECTION LABEL ===== */
        .cb-section-label {
            text-align: center;
            margin-bottom: 56px;
        }
        .cb-section-label h2 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 12px;
        }
        .cb-section-label h2 span { color: var(--cb-gold); }
        .cb-section-label p {
            color: rgba(232,234,240,0.55);
            font-size: 1rem;
            max-width: 460px;
            margin: 0 auto;
        }

        /* ===== TEAM GRID ===== */
        .cb-team-section {
            padding: 0 24px 100px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .cb-team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 28px;
        }

        /* ===== MEMBER CARD ===== */
        .cb-card {
            background: linear-gradient(145deg, rgba(255,255,255,0.04), rgba(255,255,255,0.01));
            border: 1px solid rgba(244,196,48,0.12);
            border-radius: 24px;
            padding: 32px 28px;
            position: relative;
            overflow: hidden;
            transition: transform 0.4s ease, box-shadow 0.4s ease, border-color 0.4s ease;
            cursor: default;
        }
        .cb-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--cb-gold), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        .cb-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(244,196,48,0.12), 0 0 0 1px rgba(244,196,48,0.2);
            border-color: rgba(244,196,48,0.3);
        }
        .cb-card:hover::before { opacity: 1; }

        /* Number watermark */
        .cb-card-num {
            position: absolute;
            top: 20px; right: 24px;
            font-size: 4.5rem;
            font-weight: 900;
            color: rgba(244,196,48,0.05);
            font-family: 'Playfair Display', serif;
            line-height: 1;
            user-select: none;
        }

        /* Avatar */
        .cb-avatar-ring {
            width: 88px; height: 88px;
            border-radius: 50%;
            padding: 3px;
            background: linear-gradient(135deg, var(--cb-gold), #c8961e);
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }
        .cb-avatar-inner {
            width: 100%; height: 100%;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--cb-navy-light), var(--cb-navy-mid));
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem;
            font-weight: 800;
            color: var(--cb-gold);
            font-family: 'Playfair Display', serif;
        }
        .cb-avatar-pulse {
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            border: 1.5px solid rgba(244,196,48,0.25);
            animation: pulse-ring 3s ease-in-out infinite;
        }
        @keyframes pulse-ring {
            0%,100% { transform: scale(1); opacity: 0.6; }
            50%      { transform: scale(1.08); opacity: 0.2; }
        }

        /* Name & role */
        .cb-card-name {
            font-size: 1.35rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 4px;
            font-family: 'Playfair Display', serif;
        }
        .cb-card-role {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--cb-gold);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 16px;
        }
        .cb-card-nim {
            font-size: 0.78rem;
            color: rgba(232,234,240,0.4);
            margin-bottom: 18px;
            font-family: monospace;
        }

        /* Bio */
        .cb-card-bio {
            font-size: 0.92rem;
            color: rgba(232,234,240,0.60);
            line-height: 1.65;
            margin-bottom: 22px;
            border-top: 1px solid rgba(244,196,48,0.08);
            padding-top: 18px;
        }

        /* Skills */
        .cb-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 24px;
        }
        .cb-skill-tag {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 999px;
            background: rgba(244,196,48,0.10);
            border: 1px solid rgba(244,196,48,0.20);
            color: var(--cb-gold-light);
            letter-spacing: 0.02em;
            transition: background 0.25s;
        }
        .cb-skill-tag:hover {
            background: rgba(244,196,48,0.22);
        }

        /* Social links */
        .cb-socials {
            display: flex;
            gap: 10px;
        }
        .cb-social-btn {
            width: 36px; height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(244,196,48,0.20);
            background: rgba(244,196,48,0.05);
            display: flex; align-items: center; justify-content: center;
            color: rgba(244,196,48,0.7);
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .cb-social-btn:hover {
            background: rgba(244,196,48,0.15);
            border-color: rgba(244,196,48,0.5);
            color: var(--cb-gold);
            box-shadow: 0 0 12px rgba(244,196,48,0.25);
        }
        .nav-pill-corebyte {
            background: transparent;
        }
        .nav-pill-corebyte:hover {
            box-shadow: 0 0 15px rgba(244,196,48,0.3);
        }
        .cb-social-btn svg { width: 16px; height: 16px; }

        /* ===== STATS BAR ===== */
        .cb-stats {
            padding: 56px 24px;
            background: linear-gradient(90deg, rgba(244,196,48,0.06), rgba(244,196,48,0.03), rgba(244,196,48,0.06));
            border-top: 1px solid rgba(244,196,48,0.1);
            border-bottom: 1px solid rgba(244,196,48,0.1);
            margin-bottom: 72px;
        }
        .cb-stats-inner {
            max-width: 900px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 32px;
            text-align: center;
        }
        .cb-stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            font-weight: 900;
            color: var(--cb-gold);
            line-height: 1;
            margin-bottom: 8px;
        }
        .cb-stat-label {
            font-size: 0.88rem;
            color: rgba(232,234,240,0.5);
            font-weight: 500;
            letter-spacing: 0.03em;
        }

        /* ===== CTA FOOTER ===== */
        .cb-cta {
            padding: 80px 24px 100px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cb-cta-bg {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at center, rgba(244,196,48,0.08) 0%, transparent 70%);
            pointer-events: none;
        }
        .cb-cta h3 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 16px;
            position: relative;
        }
        .cb-cta p {
            color: rgba(232,234,240,0.55);
            font-size: 1rem;
            max-width: 460px;
            margin: 0 auto 36px;
            position: relative;
        }
        .cb-btn-gold {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 16px 36px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--cb-gold), #c8961e);
            color: var(--cb-navy);
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            box-shadow: 0 8px 32px rgba(244,196,48,0.3);
        }
        .cb-btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 48px rgba(244,196,48,0.45);
        }
        .cb-btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            border-radius: 999px;
            border: 1.5px solid rgba(244,196,48,0.4);
            color: var(--cb-gold);
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-left: 12px;
        }
        .cb-btn-outline:hover {
            background: rgba(244,196,48,0.08);
            border-color: rgba(244,196,48,0.7);
        }

        /* ===== COREBYTE LOGO ICON SVG ===== */
        .cb-icon-header {
            width: 52px; height: 52px;
            margin: 0 auto 20px;
        }

        /* responsive */
        @media (max-width: 640px) {
            .cb-hero { padding: 80px 20px 60px; }
            .cb-team-grid { grid-template-columns: 1fr; }
            .cb-orbit, .cb-orbit-2, .cb-orbit-3 { display: none; }
            .cb-btn-outline { margin-left: 0; margin-top: 12px; }
        }
    </style>

    <div class="cb-page" style="position: relative;">
        <canvas id="cb-network-canvas"></canvas>

        {{-- ========== HERO ========== --}}
        <section class="cb-hero">
            <div class="cb-bg-grid"></div>
            <div class="cb-bg-glow-1"></div>
            <div class="cb-bg-glow-2"></div>

            {{-- Orbital animation --}}
            <div class="cb-orbit-wrap">
                <div class="cb-orbit cb-orbit-3"></div>
                <div class="cb-orbit"></div>
                <div class="cb-orbit cb-orbit-2"></div>
            </div>

            <div class="cb-hero-inner">
                {{-- Corebyte SVG logo icon --}}
                <div class="cb-icon-header">
                    <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="46" stroke="#F4C430" stroke-width="3"/>
                        <circle cx="50" cy="50" r="14" stroke="#F4C430" stroke-width="2.5"/>
                        <ellipse cx="50" cy="50" rx="46" ry="18" stroke="#F4C430" stroke-width="1.5" stroke-dasharray="4 3"
                            transform="rotate(-30 50 50)"/>
                        <circle cx="50" cy="4" r="5" fill="#F4C430"/>
                        <circle cx="50" cy="50" r="5" fill="#F4C430"/>
                    </svg>
                </div>

                <div class="cb-logo-badge">
                    <span class="dot"></span>
                    COREBYTE JOGJATOUCH TEAM
                    <span class="dot"></span>
                </div>

                <h1 class="cb-hero-title">
                    Meet the <span class="gold">Core</span>byte<br>Team
                </h1>
                <p class="cb-hero-sub">
                    Lima individu dengan satu visi untuk membangun solusi digital yang inovatif, handal, dan berdampak nyata bagi ekosistem teknologi Indonesia.
                </p>

                <div class="cb-divider">
                    <div class="cb-divider-line"></div>
                    <div class="cb-divider-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                        </svg>
                    </div>
                    <div class="cb-divider-line"></div>
                </div>

                {{-- Stats --}}
                <div style="display:inline-grid; grid-template-columns:repeat(3,1fr); gap:32px 48px; text-align:center; max-width:500px; margin:0 auto;">
                    <div>
                        <div class="cb-stat-num" style="font-size:2rem;">5</div>
                        <div class="cb-stat-label">Anggota Tim</div>
                    </div>
                    <div>
                        <div class="cb-stat-num" style="font-size:2rem;">1</div>
                        <div class="cb-stat-label">Proyek Aktif</div>
                    </div>
                    <div>
                        <div class="cb-stat-num" style="font-size:2rem;">∞</div>
                        <div class="cb-stat-label">Semangat</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ========== STATS BAR ========== --}}
        <div class="cb-stats">
            <div class="cb-stats-inner">
                <div>
                    <div class="cb-stat-num">5</div>
                    <div class="cb-stat-label">Anggota Aktif</div>
                </div>
                <div>
                    <div class="cb-stat-num">3+</div>
                    <div class="cb-stat-label">Teknologi Stack</div>
                </div>
                <div>
                    <div class="cb-stat-num">2023</div>
                    <div class="cb-stat-label">Angkatan</div>
                </div>
                <div>
                    <div class="cb-stat-num">100%</div>
                    <div class="cb-stat-label">Dedikasi</div>
                </div>
            </div>
        </div>

        {{-- ========== TEAM CARDS ========== --}}
        <section class="cb-team-section">
            <div class="cb-section-label">
                <h2>Our <span>Brilliant</span> Team</h2>
                <p>Kenali lebih dekat individu-individu di balik Corebyte: kreator, developer, dan pemikir yang membawa JogjaTouch ke level berikutnya.</p>
            </div>

            <div class="cb-team-grid">

                {{-- ===== MEMBER 1 — Muhammad Fadhillah ===== --}}
                <div class="cb-card">
                    <div class="cb-card-num">01</div>
                    <div class="cb-avatar-ring">
                        <div class="cb-avatar-inner">MF</div>
                        <div class="cb-avatar-pulse"></div>
                    </div>
                    <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px; flex-wrap:wrap;">
                        <div class="cb-card-name" style="margin-bottom:0;">Muhammad Fadhillah</div>
                        <span style="display:inline-flex; align-items:center; gap:4px; background:rgba(244,196,48,0.12); border:1px solid rgba(244,196,48,0.35); border-radius:999px; padding:2px 10px; font-size:0.65rem; font-weight:700; color:#F4C430; text-transform:uppercase; letter-spacing:0.08em; flex-shrink:0;">👑 Ketua</span>
                    </div>
                    <div class="cb-card-role">Team Lead &amp; Frontend Developer</div>
                    <div class="cb-card-nim" style="display:flex; align-items:center; gap:6px;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(244,196,48,0.5)" stroke-width="2" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.12 1.22 2 2 0 012.1 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.09a16 16 0 006 6l.46-.46a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                        
                    </div>
                    <p class="cb-card-bio">
                        Pemimpin tim sekaligus Frontend Developer berpengalaman yang mengorkestrasi alur kerja tim Corebyte. Menguasai desain antarmuka modern dengan HTML, CSS, JavaScript, dan Laravel — memastikan setiap halaman JogjaTouch tampil memukau dan responsif. Juga andal dalam analisis data untuk mendukung pengambilan keputusan berbasis data.
                    </p>
                    <div class="cb-skills">
                        <span class="cb-skill-tag">Frontend Dev</span>
                        <span class="cb-skill-tag">HTML/CSS</span>
                        <span class="cb-skill-tag">JavaScript</span>
                        <span class="cb-skill-tag">Laravel</span>
                        <span class="cb-skill-tag">Data Analyst</span>
                        <span class="cb-skill-tag">Team Leader</span>
                        <span class="cb-skill-tag">Git</span>
                    </div>
                    <div class="cb-socials">
                        <a href="https://github.com/fadhillah714" target="_blank" class="cb-social-btn" title="GitHub @fadhillah714">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                        </a>
                       
                    </div>
                </div>

                {{-- ===== MEMBER 2 — Vegli Raif Rafi'i ===== --}}
                <div class="cb-card">
                    <div class="cb-card-num">02</div>
                    <div class="cb-avatar-ring">
                        <div class="cb-avatar-inner">VR</div>
                        <div class="cb-avatar-pulse"></div>
                    </div>
                    <div class="cb-card-name">Vegli Raif Rafi'i</div>
                    <div class="cb-card-role">Frontend Developer &amp; UI/UX Designer</div>
                    <div class="cb-card-nim" style="display:flex; align-items:center; gap:6px;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(244,196,48,0.5)" stroke-width="2" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.12 1.22 2 2 0 012.1 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.09a16 16 0 006 6l.46-.46a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                        
                    </div>
                    <p class="cb-card-bio">
                        Kreator visual yang mengubah wireframe menjadi antarmuka pengguna yang indah dan intuitif. Ahli dalam prototyping di Figma dan implementasi frontend yang pixel-perfect. Berperan besar dalam membentuk identitas visual JogjaTouch — dari palet warna hingga micro-animation. Didukung kemampuan data analytics untuk memahami perilaku pengguna.
                    </p>
                    <div class="cb-skills">
                        <span class="cb-skill-tag">Frontend Dev</span>
                        <span class="cb-skill-tag">Figma</span>
                        <span class="cb-skill-tag">UI/UX Design</span>
                        <span class="cb-skill-tag">Laravel</span>
                        <span class="cb-skill-tag">HTML/CSS</span>
                        <span class="cb-skill-tag">Data Analyst</span>
                        <span class="cb-skill-tag">Prototyping</span>
                    </div>
                    <div class="cb-socials">
                        <a href="https://github.com/vegliraif" target="_blank" class="cb-social-btn" title="GitHub @vegliraif">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                        </a>
                        
                    </div>
                </div>

                {{-- ===== MEMBER 3 — Editya Chandra Rahmadani ===== --}}
                <div class="cb-card">
                    <div class="cb-card-num">03</div>
                    <div class="cb-avatar-ring">
                        <div class="cb-avatar-inner">EC</div>
                        <div class="cb-avatar-pulse"></div>
                    </div>
                    <div class="cb-card-name">Editya Chandra Rahmadani</div>
                    <div class="cb-card-role">Backend Developer, Database Engineer &amp; QA Tester</div>
                    <div class="cb-card-nim" style="display:flex; align-items:center; gap:6px;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(244,196,48,0.5)" stroke-width="2" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.12 1.22 2 2 0 012.1 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.09a16 16 0 006 6l.46-.46a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                        
                    </div>
                    <p class="cb-card-bio">
                        Backend developer yang solid dengan spesialisasi di Laravel dan manajemen arsitektur database. Selain merancang query database yang cepat dan terstruktur, Editya juga berperan sebagai QA Tester — memastikan setiap fitur JogjaTouch berfungsi tanpa bug sebelum rilis. Kemampuan data analytics-nya mendukung pembuatan laporan performa sistem secara mendalam.
                    </p>
                    <div class="cb-skills">
                        <span class="cb-skill-tag">Backend Dev</span>
                        <span class="cb-skill-tag">Database Engineer</span>
                        <span class="cb-skill-tag">Laravel</span>
                        <span class="cb-skill-tag">MySQL</span>
                        <span class="cb-skill-tag">QA Testing</span>
                        <span class="cb-skill-tag">REST API</span>
                        <span class="cb-skill-tag">Data Analyst</span>
                        <span class="cb-skill-tag">Postman</span>
                    </div>
                    <div class="cb-socials">
                        <a href="https://github.com/EdityaChandra" target="_blank" class="cb-social-btn" title="GitHub @EdityaChandra">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                        </a>
                       
                    </div>
                </div>

                {{-- ===== MEMBER 4 — Septian Eko Nugroho ===== --}}
                <div class="cb-card">
                    <div class="cb-card-num">04</div>
                    <div class="cb-avatar-ring">
                        <div class="cb-avatar-inner">SE</div>
                        <div class="cb-avatar-pulse"></div>
                    </div>
                    <div class="cb-card-name">Septian Eko Nugroho</div>
                    <div class="cb-card-role">Backend Developer, Database Engineer &amp; Data Analyst</div>
                    <div class="cb-card-nim" style="display:flex; align-items:center; gap:6px;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(244,196,48,0.5)" stroke-width="2" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.12 1.22 2 2 0 012.1 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.09a16 16 0 006 6l.46-.46a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                        
                    </div>
                    <p class="cb-card-bio">
                        Backend developer yang berfokus pada perancangan sistem yang skalabel dan arsitektur database yang efisien. Membangun logika server-side menggunakan Laravel dan PHP. Keahlian data analytics-nya digunakan untuk mengolah data transaksi JogjaTouch, menghasilkan insight berharga untuk optimalisasi skema data.
                    </p>
                    <div class="cb-skills">
                        <span class="cb-skill-tag">Backend Dev</span>
                        <span class="cb-skill-tag">Database Engineer</span>
                        <span class="cb-skill-tag">Laravel</span>
                        <span class="cb-skill-tag">PHP</span>
                        <span class="cb-skill-tag">MySQL</span>
                        <span class="cb-skill-tag">Data Analyst</span>
                        <span class="cb-skill-tag">REST API</span>
                        <span class="cb-skill-tag">Git</span>
                    </div>
                    <div class="cb-socials">
                        <a href="https://github.com/seppp99" target="_blank" class="cb-social-btn" title="GitHub @seppp99">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                        </a>
                        
                    </div>
                </div>

                {{-- ===== MEMBER 5 — Abhirama Balaphradana Vishnu R ===== --}}
                <div class="cb-card">
                    <div class="cb-card-num">05</div>
                    <div class="cb-avatar-ring">
                        <div class="cb-avatar-inner">AB</div>
                        <div class="cb-avatar-pulse"></div>
                    </div>
                    <div class="cb-card-name">Abhirama Balaphradana Vishnu R</div>
                    <div class="cb-card-role">Frontend Dev · Server Admin · Network Engineer</div>
                    <div class="cb-card-nim" style="display:flex; align-items:center; gap:6px;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(244,196,48,0.5)" stroke-width="2" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.12 1.22 2 2 0 012.1 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.09a16 16 0 006 6l.46-.46a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                    
                    </div>
                    <p class="cb-card-bio">
                        Full-stack engineer dengan expertise luar biasa di sisi infrastruktur dan keamanan. Mengelola server JogjaTouch via cPanel dan Linux, melakukan Security Assessment untuk menjaga keamanan data pengguna, serta menganalisis jaringan (Network Analyst). Di sisi frontend, ia merancang komponen yang responsif dan cepat. Analis data handal yang melengkapi kepiawaian teknisnya.
                    </p>
                    <div class="cb-skills">
                        <span class="cb-skill-tag">Frontend Dev</span>
                        <span class="cb-skill-tag">Server Admin</span>
                        <span class="cb-skill-tag">cPanel</span>
                        <span class="cb-skill-tag">Linux</span>
                        <span class="cb-skill-tag">Security Assessment</span>
                        <span class="cb-skill-tag">Network Analyst</span>
                        <span class="cb-skill-tag">Laravel</span>
                        <span class="cb-skill-tag">Data Analyst</span>
                    </div>
                    <div class="cb-socials">
                        <a href="https://github.com/Abhiramabvr" target="_blank" class="cb-social-btn" title="GitHub @Abhiramabvr">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                        
                        </a>
                    </div>
                </div>

            </div>{{-- end grid --}}
        </section>

        {{-- ========== CTA FOOTER ========== --}}
        <section class="cb-cta">
            <div class="cb-cta-bg"></div>
            {{-- Decorative line --}}
            <div style="width:1px; height:60px; background:linear-gradient(to bottom, transparent, rgba(244,196,48,0.4)); margin:0 auto 48px;"></div>
            <h3>Siap Berkolaborasi?</h3>
            <p>Kami terbuka untuk kolaborasi, diskusi, dan peluang baru. Jangan ragu untuk menghubungi tim Corebyte.</p>
            <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:12px;">
                <a href="https://wa.me/6281779911230" target="_blank" class="cb-btn-gold">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.12 1.22 2 2 0 012.1 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.09a16 16 0 006 6l.46-.46a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/>
                    </svg>
                    Hubungi Kami
                </a>
                <a href="{{ url('/') }}" class="cb-btn-outline">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </section>

    </div>

    @push('scripts')
    <script>
        // Intersection Observer for card entrance animation
        const cards = document.querySelectorAll('.cb-card');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, i * 100);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease, box-shadow 0.4s ease, border-color 0.4s ease';
            observer.observe(card);
        });

        // ===== DYNAMIC NETWORK NODES BG ENGINE =====
        const canvas = document.getElementById('cb-network-canvas');
        const ctx = canvas.getContext('2d');

        let particles = [];
        const maxParticles = 60; // controlled amount for clean, fast rendering
        const minDistance = 110;  // connection distance threshold

        function resizeCanvas() {
            // Match the parent scrollable container's full height
            const parent = canvas.parentElement;
            canvas.width = parent.clientWidth;
            canvas.height = parent.scrollHeight;
        }

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                // Slow tech-like drift velocities
                this.vx = (Math.random() - 0.5) * 0.4;
                this.vy = (Math.random() - 0.5) * 0.4;
                this.radius = Math.random() * 2 + 1;
            }

            update() {
                this.x += this.vx;
                this.y += this.vy;

                // Bounce at canvas boundaries
                if (this.x < 0 || this.x > canvas.width) this.vx *= -1;
                if (this.y < 0 || this.y > canvas.height) this.vy *= -1;
            }

            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(244, 196, 48, 0.4)';
                ctx.fill();
            }
        }

        function initParticles() {
            particles = [];
            for (let i = 0; i < maxParticles; i++) {
                particles.push(new Particle());
            }
        }

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Update and draw particles
            particles.forEach(p => {
                p.update();
                p.draw();
            });

            // Draw connection links
            for (let i = 0; i < particles.length; i++) {
                for (let j = i + 1; j < particles.length; j++) {
                    const p1 = particles[i];
                    const p2 = particles[j];
                    const dx = p1.x - p2.x;
                    const dy = p1.y - p2.y;
                    const dist = Math.sqrt(dx * dx + dy * dy);

                    if (dist < minDistance) {
                        const alpha = (1 - dist / minDistance) * 0.15; // smooth fading line
                        ctx.beginPath();
                        ctx.moveTo(p1.x, p1.y);
                        ctx.lineTo(p2.x, p2.y);
                        ctx.strokeStyle = `rgba(244, 196, 48, ${alpha})`;
                        ctx.lineWidth = 0.8;
                        ctx.stroke();
                    }
                }
            }

            requestAnimationFrame(animate);
        }

        // Initialize background network grid
        window.addEventListener('resize', () => {
            resizeCanvas();
        });

        // Run setup
        resizeCanvas();
        initParticles();
        animate();
    </script>
    @endpush
</x-layouts.app>
