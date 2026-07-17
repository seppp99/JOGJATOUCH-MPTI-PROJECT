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
                TextColumn::make('service_slug')
                    ->searchable(),
                TextColumn::make('package_selected')
                    ->searchable(),
                TextColumn::make('nama_perusahaan')
                    ->searchable(),
                TextColumn::make('no_whatsapp')
                    ->searchable(),
                TextColumn::make('email_kerja')
                    ->searchable(),
                TextColumn::make('jumlah_karyawan')
                    ->searchable(),
                TextColumn::make('jumlah_lokasi')
                    ->searchable(),
                TextColumn::make('perangkat_utama')
                    ->searchable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
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
