<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    /**
     * Tanpa tombol "New user".
     *
     * Akun dibuat lewat halaman Daftar di situs customer. Halaman
     * /admin/users/create sendiri TIDAK ikut diblokir, jadi rutenya masih bisa
     * diakses lewat URL langsung - kalau pembuatan user dari panel memang mau
     * ditutup sepenuhnya, UserResource perlu canCreate(): false seperti
     * OrderResource.
     */
    protected function getHeaderActions(): array
    {
        return [];
    }
}
