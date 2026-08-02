{{--
    Override dari filament-panels::components.avatar.user.

    Alasan: view bawaan merender <img src="https://ui-avatars.com/api/…"> —
    gambar dari layanan EKSTERNAL yang latarnya opak, sehingga gradient oranye
    yang ditulis di theme.css tertutup total dan tidak pernah terlihat.

    Di sini inisial dirender sebagai elemen HTML biasa, jadi gradient benar-benar
    tampil. Efek sampingnya: panel tidak lagi memanggil layanan pihak ketiga
    untuk setiap avatar.

    Berlaku di semua tempat yang memakai x-filament-panels::avatar.user
    (trigger user menu di topbar, dan lainnya bila ada).
--}}
@props([
    'user' => filament()->auth()->user(),
])

@php
    $name = trim((string) filament()->getUserName($user));
    $words = preg_split('/\s+/', $name, -1, PREG_SPLIT_NO_EMPTY) ?: [];

    // Dua huruf: awal kata pertama + awal kata terakhir ("Rusdi Admin" -> "RA").
    // Kalau namanya satu kata, ambil satu huruf saja.
    $initials = mb_strtoupper(
        mb_substr($words[0] ?? '?', 0, 1) .
        (count($words) > 1 ? mb_substr($words[count($words) - 1], 0, 1) : '')
    );
@endphp

<span
    {{
        $attributes
            ->except(['loading', 'src'])
            ->class(['fi-avatar fi-circular fi-size-md fi-user-avatar jt-avatar'])
    }}
    title="{{ $name }}"
    aria-hidden="true"
>{{ $initials }}</span>
