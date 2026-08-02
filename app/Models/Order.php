<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_code',
        'layanan_id',
        'paket_dipilih',
        'nama_pelanggan',
        'whatsapp_number',
        'email',
        'detail_kebutuhan',
        'alamat',
        'custom_fields',
        'status',
        'harga_fix',
        'tanggal_pelaksanaan'
    ];

    protected $casts = [
        'custom_fields' => 'array',
        'tanggal_pelaksanaan' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Konfirmasi',
            'deal' => 'Diproses',
            'completed' => 'Selesai',
            'canceled' => 'Dibatalkan',
            default => ucfirst($this->status),
        };
    }
}
