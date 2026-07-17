<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('service_slug')
                    ->required(),
                TextInput::make('package_selected')
                    ->required(),
                TextInput::make('nama_perusahaan')
                    ->required(),
                TextInput::make('no_whatsapp')
                    ->required(),
                TextInput::make('email_kerja')
                    ->email()
                    ->required(),
                TextInput::make('jumlah_karyawan')
                    ->default(null),
                TextInput::make('jumlah_lokasi')
                    ->default(null),
                TextInput::make('perangkat_utama')
                    ->default(null),
                Textarea::make('masalah_utama')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('alamat_lokasi')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('custom_fields')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
            ]);
    }
}
