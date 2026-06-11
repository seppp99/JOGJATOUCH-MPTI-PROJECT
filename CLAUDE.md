# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

**Jogjatouch** is a Laravel 12 service booking website for an IT/design/print company in Yogyakarta. Customers browse 6 service categories (WiFi installation, network analysis, PC assembly, maintenance, graphic design, printing), view packages, and submit orders via dynamic forms. The app stores orders in a database with a flexible JSON `custom_fields` column for service-specific data.

## Commands

**Initial setup (new environment):**
```bash
composer run setup
# Runs: composer install → create .env → key:generate → migrate → npm install → npm run build
```

**Start full dev stack (PHP server + queue + logs + Vite HMR, all concurrent):**
```bash
composer run dev
```

**Run tests:**
```bash
composer run test
# Clears config cache, then runs php artisan test (uses in-memory SQLite + array cache)
```

**Run a single test:**
```bash
php artisan test --filter ExampleTest
php artisan test tests/Feature/ExampleTest.php
```

**Production build:**
```bash
npm run build
```

**Lint/format PHP:**
```bash
./vendor/bin/pint
```

**Database:**
```bash
php artisan migrate
php artisan migrate:fresh  # DESTRUCTIVE — drops all tables
```

## Architecture

**Request flow:**
```
/ (home)  →  /layanan/{slug} (service detail)  →  POST /layanan/{slug}/order
```

**Routes** ([routes/web.php](routes/web.php)): Only 3 routes — home view, service detail via `LayananController@show`, order form submission via `LayananController@store`. No API routes yet.

**Service slugs:** `pemasangan-wifi`, `network-analyst`, `perawatan-rutin`, `rakit-pc`, `desain-grafis`, `printing-cetak`

**Critical pattern — services are hardcoded, not in the database.** All 6 services and their 3 package options each live in `LayananController::getServices()` as a PHP array. To add/edit services or packages, modify this method directly.

**Order model** ([app/Models/Order.php](app/Models/Order.php)) stores form submissions. The base schema has fixed columns: `service_slug`, `package_selected`, `nama_perusahaan`, `no_whatsapp`, `email_kerja`, `jumlah_karyawan`, `jumlah_lokasi`, `perangkat_utama`, `masalah_utama`, `alamat_lokasi`, `status`. Service-specific extras go into `custom_fields` (JSON, cast to array).

**Database readiness check:** `store()` wraps `Order::create()` in a `Schema::hasTable('orders')` check — the app works in "preview mode" without an active database, showing a session-flashed success message regardless.

### Form field routing (critical when adding new fields)

[resources/views/pages/layanan-detail.blade.php](resources/views/pages/layanan-detail.blade.php) has two branches:

1. **`@if($service['slug'] === 'network-analyst')`** — fully custom layout with all fields hardcoded for that service.
2. **`@else`** — generic layout used by all other 5 services, with service-specific extras injected via nested `@if/$service['slug']`:
   - `pemasangan-wifi`: adds `luas_bangunan`, `jumlah_lantai`
   - `rakit-pc`: adds `budget`
   - `printing-cetak`: adds `link_desain`

Any form field not listed in `$baseFields` inside `store()` is automatically captured into `custom_fields`. When adding a new named column to the `orders` table, also add the field name to `$baseFields` so it doesn't double-save to `custom_fields`.

**Known mismatch:** `alamat_lokasi` is server-required for both `network-analyst` and `perawatan-rutin`, but in the Blade template the generic branch renders it as optional (no `required` attribute). The `network-analyst`-specific branch marks it `required`.

### Frontend

Vite 7 + Tailwind v4. Entry points: [resources/css/app.css](resources/css/app.css), [resources/js/app.js](resources/js/app.js). Custom color palette: cream `#FBF9F6`, dark brown `#1E1B19`, orange `#E35D25`.

Layout wrapper: `<x-layouts.app>` maps to [resources/views/components/layouts/app.blade.php](resources/views/components/layouts/app.blade.php). Page-specific scripts go in `@push('scripts')`.

**Scroll-spy:** [resources/js/nav-scroll.js](resources/js/nav-scroll.js) uses IntersectionObserver to highlight `.nav-pill` links. Tracked section IDs: `#home`, `#tentang`, `#layanan`, `#nilai`, `#fitur`, `#cta`, `#tracking`. Adding a new navbar-linked section requires an `id` attribute matching the `href` of a `.nav-pill` anchor.

**Blade components** under [resources/views/components/](resources/views/components/): `navbar`, `hero` (contains both `#home` and `#tentang` sections), `layanan`, `nilai`, `fitur`, `cta`, `ticker`, `tracking`, `footer`.

**Optional image assets:** [resources/views/components/hero.blade.php](resources/views/components/hero.blade.php) checks for `public/assets/about/kualitas.jpg`, `waktu.jpg`, `pelayanan.jpg` and falls back to CSS gradients if absent.

## Key Facts

- **Database:** SQLite by default (`database/database.sqlite`). Switch to MySQL via `.env`.
- **Email:** `MAIL_MAILER=log` — emails are written to `storage/logs/`, not sent. Configure SMTP for production.
- **Auth:** `User` model exists but authentication is not implemented. No admin panel.
- **Language:** Indonesian throughout (forms, UI text, controller field names like `nama_perusahaan`, `no_whatsapp`).
- **Logo path:** `public/assets/logo jogja touch border white.png` — must exist for navbar to render correctly.
- **Invalid slug redirect:** `show()` redirects unknown slugs to `network-analyst` instead of returning 404.
