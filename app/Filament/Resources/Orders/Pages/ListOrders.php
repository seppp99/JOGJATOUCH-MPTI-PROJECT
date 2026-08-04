<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    /**
     * Tanpa tombol "New order".
     *
     * Pesanan hanya boleh lahir dari alur pemesanan di situs customer, bukan
     * dibuat manual dari panel admin - OrderResource::canCreate() sudah
     * mengembalikan false, sehingga /admin/orders/create memang menolak dengan
     * 403. Tombolnya tetap muncul karena CreateAction di sini tidak ikut
     * membaca canCreate(), jadi menghapusnya di sini yang benar-benar
     * menghilangkan tombol itu.
     */
    protected function getHeaderActions(): array
    {
        return [];
    }
}
