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
                \Filament\Schemas\Components\Section::make('Informasi Pelanggan & Pesanan')
                    ->description('Data ini adalah snapshot dari sistem saat pelanggan memesan dan tidak dapat diubah.')
                    ->components([
                        TextInput::make('order_code')
                            ->label('Order Code')
                            ->disabled(),
                        TextInput::make('layanan_id')
                            ->label('Layanan')
                            ->disabled(),
                        TextInput::make('paket_dipilih')
                            ->label('Paket Dipilih')
                            ->disabled(),
                        TextInput::make('nama_pelanggan')
                            ->label('Nama Pelanggan')
                            ->disabled(),
                        TextInput::make('whatsapp_number')
                            ->label('No. WhatsApp')
                            ->disabled(),
                        TextInput::make('email')
                            ->label('Email')
                            ->disabled(),
                        \Filament\Forms\Components\DateTimePicker::make('created_at')
                            ->label('Waktu Pemesanan')
                            ->disabled(),
                        Textarea::make('detail_kebutuhan')
                            ->label('Detail Kebutuhan')
                            ->disabled()
                            ->columnSpanFull(),
                        Textarea::make('alamat')
                            ->label('Alamat')
                            ->disabled()
                            ->columnSpanFull(),
                    ])->columns(2),

                \Filament\Schemas\Components\Section::make('Detail Kustom')
                    ->description('Atribut spesifik sesuai layanan yang dipilih.')
                    ->components([
                        \Filament\Forms\Components\KeyValue::make('custom_fields')
                            ->label('')
                            ->keyLabel('Atribut')
                            ->valueLabel('Nilai')
                            ->disabled()
                            ->columnSpanFull(),
                    ]),

                \Filament\Schemas\Components\Section::make('Status & Tindak Lanjut')
                    ->description('Diperbarui oleh admin setelah negosiasi.')
                    ->components([
                        \Filament\Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending',
                                'deal' => 'Deal',
                                'canceled' => 'Canceled',
                                'completed' => 'Completed',
                            ])
                            ->required()
                            ->default('pending'),
                        TextInput::make('harga_fix')
                            ->label('Harga Fix (Rp)')
                            ->numeric()
                            ->prefix('Rp')
                            ->nullable(),
                        \Filament\Forms\Components\DatePicker::make('tanggal_pelaksanaan')
                            ->label('Tanggal Pelaksanaan')
                            ->nullable(),
                    ])->columns(2),
            ]);
    }
}
