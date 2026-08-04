<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('layanan_id')
                    ->label('Layanan')
                    ->searchable(),
                TextColumn::make('paket_dipilih')
                    ->label('Paket'),
                TextColumn::make('nama_pelanggan')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('whatsapp_number')
                    ->label('WhatsApp'),
                TextColumn::make('status')
                    ->badge()
                    // Dipetakan ke warna yang sama dengan badge status di situs
                    // customer (dashboard-orders.blade.php baris 22-25):
                    // pending=blue, deal=amber, completed=emerald, canceled=rose.
                    // Sebelumnya pending memakai warning (amber) dan deal memakai
                    // success (emerald), sehingga tidak cocok dengan customer.
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'info',      // blue
                        'deal' => 'warning',      // amber
                        'completed' => 'success', // emerald
                        'canceled' => 'danger',   // rose
                        default => 'gray',
                    }),
                TextColumn::make('harga_fix')
                    ->label('Harga Fix')
                    ->numeric()
                    ->money('IDR', locale: 'id'),
                TextColumn::make('tanggal_pelaksanaan')
                    ->label('Tanggal Pelaksanaan')
                    ->date(),
                TextColumn::make('created_at')
                    ->label('Dipesan')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'deal' => 'Deal',
                        'canceled' => 'Canceled',
                        'completed' => 'Completed',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
