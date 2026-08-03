{{--
    Override dari filament-panels::widgets.account-widget.

    SATU-SATUNYA perubahan terhadap view vendor ada di baris nama: vendor memakai
    filament()->getUserName($user), yang kini mengembalikan EMAIL karena User
    mengimplementasikan kontrak HasName (lihat App\Models\User::getFilamentName()).
    Di kartu "Welcome" ini yang diinginkan justru NAMA, jadi kolom `name` dibaca
    langsung dari model.

    Pembagiannya sekarang:
      pill topbar & header popup  -> email  (lewat getFilamentName())
      kartu Welcome di dashboard  -> nama   (view ini)
      inisial avatar              -> nama   (override avatar/user.blade.php)

    Sisa berkas disalin apa adanya dari
    vendor/filament/filament/resources/views/widgets/account-widget.blade.php
    supaya tombol Sign out dan strukturnya tidak berubah.
--}}
@php
    $user = filament()->auth()->user();

    $displayName = filled($user?->name) ? $user->name : filament()->getUserName($user);
@endphp

<x-filament-widgets::widget class="fi-account-widget">
    <x-filament::section>
        <x-filament-panels::avatar.user
            size="lg"
            :user="$user"
            loading="lazy"
        />

        <div class="fi-account-widget-main">
            <h2 class="fi-account-widget-heading">
                {{ __('filament-panels::widgets/account-widget.welcome', ['app' => config('app.name')]) }}
            </h2>

            <p class="fi-account-widget-user-name">
                {{ $displayName }}
            </p>
        </div>

        <form
            action="{{ filament()->getLogoutUrl() }}"
            method="post"
            class="fi-account-widget-logout-form"
        >
            @csrf

            <x-filament::button
                color="gray"
                :icon="\Filament\Support\Icons\Heroicon::ArrowLeftEndOnRectangle"
                :icon-alias="\Filament\View\PanelsIconAlias::WIDGETS_ACCOUNT_LOGOUT_BUTTON"
                labeled-from="sm"
                tag="button"
                type="submit"
            >
                {{ __('filament-panels::widgets/account-widget.actions.logout.label') }}
            </x-filament::button>
        </form>
    </x-filament::section>
</x-filament-widgets::widget>
