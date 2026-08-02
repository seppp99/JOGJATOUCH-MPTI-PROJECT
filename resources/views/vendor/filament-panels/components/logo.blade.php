{{--
    Override dari filament-panels::components.logo.

    Alasan: view bawaan Filament (vendor/filament/filament/resources/views/
    components/logo.blade.php) merender brandLogo ATAU brandName — tidak pernah
    keduanya. Begitu brandLogo() diisi, brandName() hanya dipakai sebagai teks
    alt, sehingga sidebar cuma menampilkan ikon tanpa wordmark.

    Di sini keduanya dirender bersebelahan, meniru navbar situs customer
    (resources/views/components/navbar.blade.php baris 6-11): ikon di dalam
    kotak putih rounded-xl, lalu wordmark "Jogja" + "touch" oranye dengan
    Playfair Display.
--}}
@php
    $brandName = filament()->getBrandName();
    $brandLogo = filament()->getBrandLogo();
    $brandLogoHeight = filament()->getBrandLogoHeight() ?? '1.5rem';
@endphp

<div {{ $attributes->class(['fi-logo fi-logo-jt']) }}>
    @if (filled($brandLogo))
        <span class="fi-logo-jt-mark">
            <img
                src="{{ $brandLogo }}"
                alt="{{ __('filament-panels::layout.logo.alt', ['name' => $brandName]) }}"
                style="height: {{ e($brandLogoHeight) }}"
            />
        </span>
    @endif

    <span class="fi-logo-jt-wordmark">Jogja<span class="fi-logo-jt-accent">touch</span></span>
</div>
