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
        'status'
    ];

    protected $casts = [
        'custom_fields' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
