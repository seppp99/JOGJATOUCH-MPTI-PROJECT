<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'service_slug',
        'package_selected',
        'nama_perusahaan',
        'no_whatsapp',
        'email_kerja',
        'jumlah_karyawan',
        'jumlah_lokasi',
        'perangkat_utama',
        'masalah_utama',
        'alamat_lokasi',
        'custom_fields', // Store dynamic fields from other forms in JSON
        'status',
    ];

    protected $casts = [
        'custom_fields' => 'array',
    ];
}
