{{--
    Override dari filament-panels::components.user-menu.

    SATU-SATUNYA perubahan terhadap view vendor ada di slot "trigger": Filament
    punya dua varian trigger — varian topbar yang HANYA menampilkan avatar, dan
    varian sidebar yang menampilkan avatar + nama + chevron. Di sini varian
    lengkap dipakai untuk kedua posisi, supaya pill profil di topbar sama dengan
    pill profil di navbar situs customer (avatar + nama + chevron).

    Seluruh isi dropdown di bawah trigger disalin apa adanya dari vendor agar
    fungsinya (menu profil, theme switcher, logout) tidak berubah sama sekali.

    Sumber: vendor/filament/filament/resources/views/components/user-menu.blade.php
--}}
@props([
    'position' => null,
])

@php
    use Filament\Actions\Action;
    use Filament\Enums\UserMenuPosition;
    use Illuminate\Support\Arr;

    $user = filament()->auth()->user();

    // getUserName() mengembalikan EMAIL karena User mengimplementasikan kontrak
    // HasName (lihat App\Models\User::getFilamentName()). Nilai ini dipakai
    // Filament untuk label item "profile", yaitu header di dalam popup - dan di
    // sana memang email yang diinginkan.
    $userName = filament()->getUserName($user);

    // Teks pill di topbar memakai NAMA, bukan email. Dibaca langsung dari kolom
    // `name` supaya tidak ikut terpengaruh getFilamentName().
    $userDisplayName = filled($user?->name) ? $user->name : $userName;

    // Sumber tooltip header popup: email utuh, tidak pernah dipotong.
    $userEmail = $user?->email ?? $userName;

    // Ekspresi x-tooltip disiapkan di PHP, BUKAN ditulis inline dengan @js().
    // Sebabnya: pada KOMPONEN Blade (<x-filament::dropdown.header ...>), direktif
    // di dalam nilai atribut tidak dikompilasi - `@js($userEmail)` diteruskan
    // mentah sebagai teks sehingga Alpine mengevaluasinya jadi kosong dan
    // tooltip muncul tanpa isi (terukur: tippy-box 18x10 px, hanya panahnya).
    // Pada elemen HTML biasa seperti <button>, @js() dikompilasi normal.
    // json_encode menghasilkan literal string JS yang valid; \$store.theme
    // di-escape agar tidak diinterpolasi PHP.
    $userEmailTooltip = '{ content: ' . json_encode($userEmail) . ', theme: $store.theme }';

    $items = $this->getUserMenuItems();

    $itemsBeforeAndAfterThemeSwitcher = collect($items)
        ->groupBy(fn (Action $item): bool => $item->getSort() < 0, preserveKeys: true)
        ->all();
    $itemsBeforeThemeSwitcher = $itemsBeforeAndAfterThemeSwitcher[true] ?? collect();
    $itemsAfterThemeSwitcher = $itemsBeforeAndAfterThemeSwitcher[false] ?? collect();

    $hasProfileHeader = $itemsBeforeThemeSwitcher->has('profile') &&
        blank(($item = Arr::first($itemsBeforeThemeSwitcher))->getUrl()) &&
        (! $item->hasAction());

    if ($itemsBeforeThemeSwitcher->has('profile')) {
        $itemsBeforeThemeSwitcher = $itemsBeforeThemeSwitcher->prepend($itemsBeforeThemeSwitcher->pull('profile'), 'profile');
    }

    $multiGroupAfterTheme = $this->hasMultipleUserMenuItemGroups();
    $afterThemeItemGroups = $multiGroupAfterTheme ? $this->getUserMenuItemGroupsAfterTheme() : [];

    $position ??= filament()->getUserMenuPosition();
@endphp

{{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_BEFORE) }}

<x-filament::dropdown
    :placement="($position === UserMenuPosition::Topbar) ? 'bottom-end' : 'top-end'"
    :teleport="$position === UserMenuPosition::Topbar"
    :attributes="
        \Filament\Support\prepare_inherited_attributes($attributes)
            ->class(['fi-user-menu'])
    "
>
    <x-slot name="trigger">
        {{-- Varian lengkap dipakai untuk SEMUA posisi (lihat catatan di atas).

             Pill ini menampilkan NAMA dan sengaja TIDAK memakai x-tooltip:
             tooltip email hanya dipasang di header dalam popup. --}}
        <button
            aria-label="{{ filled($userDisplayName) ? $userDisplayName : __('filament-panels::layout.actions.open_user_menu.label') }}"
            type="button"
            class="fi-user-menu-trigger jt-user-pill"
        >
            <x-filament-panels::avatar.user :user="$user" />

            <span class="fi-user-menu-trigger-text">
                {{ $userDisplayName }}
            </span>

            {{
                \Filament\Support\generate_icon_html(
                    \Filament\Support\Icons\Heroicon::ChevronDown,
                    alias: \Filament\View\PanelsIconAlias::USER_MENU_TOGGLE_BUTTON,
                )
            }}
        </button>
    </x-slot>

    @if ($hasProfileHeader)
        @php
            $item = $itemsBeforeThemeSwitcher['profile'];
            $itemColor = $item->getColor();
            $itemIcon = $item->getIcon();

            unset($itemsBeforeThemeSwitcher['profile']);
        @endphp

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_PROFILE_BEFORE) }}

        {{-- Tooltip email dipasang DI SINI (header popup), memakai pola yang sama
             persis dengan tombol pengalih tema di bawahnya
             (vendor/filament/filament/resources/views/components/theme-switcher/
             button.blade.php baris 14-17). `theme: $store.theme` membuat warna
             tooltip otomatis mengikuti mode terang/gelap.

             Isinya email LENGKAP, sehingga tetap terbaca utuh walau teks header
             terpotong ellipsis karena lebar popup terbatas.

             x-filament::dropdown.header meneruskan $attributes ke elemen
             terluarnya, jadi x-tooltip di bawah menempel ke .fi-dropdown-header. --}}
        <x-filament::dropdown.header
            :color="$itemColor"
            :icon="$itemIcon"
            :x-tooltip="$userEmailTooltip"
        >
            {{ $item->getLabel() }}
        </x-filament::dropdown.header>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_PROFILE_AFTER) }}
    @endif

    @if ($itemsBeforeThemeSwitcher->isNotEmpty())
        <x-filament::dropdown.list>
            @foreach ($itemsBeforeThemeSwitcher as $key => $item)
                @if ($key === 'profile')
                    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_PROFILE_BEFORE) }}

                    {{ $item }}

                    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_PROFILE_AFTER) }}
                @else
                    {{ $item }}
                @endif
            @endforeach
        </x-filament::dropdown.list>
    @endif

    @if (filament()->hasDarkMode() && (! filament()->hasDarkModeForced()) && filament()->hasThemeSwitcher())
        <x-filament::dropdown.list>
            <x-filament-panels::theme-switcher />
        </x-filament::dropdown.list>
    @endif

    @if ($multiGroupAfterTheme && $afterThemeItemGroups !== [])
        @foreach ($afterThemeItemGroups as $afterThemeGroup)
            <x-filament::dropdown.list>
                @foreach ($afterThemeGroup as $key => $item)
                    @if ($key === 'profile')
                        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_PROFILE_BEFORE) }}

                        {{ $item }}

                        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_PROFILE_AFTER) }}
                    @else
                        {{ $item }}
                    @endif
                @endforeach
            </x-filament::dropdown.list>
        @endforeach
    @elseif ($itemsAfterThemeSwitcher->isNotEmpty())
        <x-filament::dropdown.list>
            @foreach ($itemsAfterThemeSwitcher as $key => $item)
                @if ($key === 'profile')
                    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_PROFILE_BEFORE) }}

                    {{ $item }}

                    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_PROFILE_AFTER) }}
                @else
                    {{ $item }}
                @endif
            @endforeach
        </x-filament::dropdown.list>
    @endif
</x-filament::dropdown>

{{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_AFTER) }}
