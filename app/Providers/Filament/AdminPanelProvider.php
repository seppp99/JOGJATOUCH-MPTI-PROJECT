<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->login()
            // Identitas visual disamakan dengan situs customer.
            ->brandName('Jogjatouch')
            ->brandLogo(asset('assets/logo jogja touch border white.png'))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('assets/logo jogja touch border white.png'))
            // Instrument Sans = font body situs customer (lihat layouts/app.blade.php).
            // Playfair Display TIDAK didaftarkan di sini karena hanya boleh dipakai
            // pada brand & judul halaman, bukan sebagai font default panel; ia
            // di-import dan diterapkan lewat theme.css.
            ->font('Instrument Sans')
            ->viteTheme('resources/css/filament/admin/theme.css')
            // Playfair Display dimuat sebagai <link>, sama seperti
            // layouts/app.blade.php di situs customer. Tidak bisa lewat @import
            // di theme.css karena Lightning CSS menolak @import yang berada di
            // tengah bundel setelah CSS Filament ter-inline.
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => <<<'HTML'
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
                    HTML,
            )
            // Badge jumlah filter aktif: view tabel Filament memaksa
            // ->badge($activeFiltersCount) SETELAH filtersTriggerAction() kita
            // dievaluasi, jadi nilainya tidak bisa dinolkan dari PHP. Karena
            // filled(0) bernilai true, angka "0" tetap dirender. CSS juga tidak
            // bisa menyeleksi berdasarkan isi teks, sehingga penyembunyian
            // dilakukan di sini: elemen ditandai .jt-badge-zero (aturan
            // display:none-nya ada di theme.css). MutationObserver dipakai agar
            // tetap benar setelah Livewire merender ulang tabel.
            ->renderHook(
                PanelsRenderHook::BODY_END,
                fn (): string => <<<'HTML'
                    <script>
                        (function () {
                            var queued = false;

                            function sweep() {
                                queued = false;
                                document.querySelectorAll('.fi-icon-btn-badge-ctn').forEach(function (el) {
                                    var value = el.textContent.trim();
                                    el.classList.toggle('jt-badge-zero', value === '' || value === '0');
                                });
                            }

                            function schedule() {
                                if (queued) return;
                                queued = true;
                                requestAnimationFrame(sweep);
                            }

                            schedule();
                            new MutationObserver(schedule).observe(document.body, {
                                childList: true,
                                subtree: true,
                                characterData: true,
                            });
                            document.addEventListener('livewire:navigated', schedule);
                        })();
                    </script>
                    HTML,
            )
            ->colors([
                'primary' => '#E35D25',
                // Skala abu-abu: Color::hex() menskalakan chroma sesuai saturasi
                // warna sumber, dan #1E1B19 nyaris tak jenuh sehingga seluruh
                // ramp keluar dengan chroma 0 alias abu MURNI — inilah sebab
                // background panel tampak putih/abu, bukan krem, karena Filament
                // memakai --gray-50/100/200 untuk permukaan terangnya.
                // Tiga stop teraterang karena itu ditimpa dengan nilai OKLCH
                // hasil konversi warna krem situs customer (dihitung memakai
                // Color::convertToOklch), sementara stop gelap dibiarkan netral
                // agar kontras teks tetap aman.
                'gray' => array_replace(Color::hex('#1E1B19'), [
                    50 => 'oklch(0.983 0.005 78.298)',  // #FBF9F6
                    100 => 'oklch(0.954 0.008 73.743)', // #F3EFEA
                    200 => 'oklch(0.915 0.013 75.362)', // #E8E2DA
                ]),
                // Disamakan dengan badge status di dashboard-orders.blade.php:
                // pending=blue, deal=amber, completed=emerald, canceled=rose.
                'info' => Color::Blue,
                'warning' => Color::Amber,
                'success' => Color::Emerald,
                'danger' => Color::Rose,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
