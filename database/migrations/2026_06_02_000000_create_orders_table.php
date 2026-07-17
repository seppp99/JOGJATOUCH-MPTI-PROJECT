<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('order_code')->unique();
            $table->string('layanan_id');          // slug/identifier layanan, mis. 'pemasangan-wifi'
            $table->string('paket_dipilih');       // nama paket, mis. 'Instalasi Rumah Standard'
            $table->string('nama_pelanggan');      // snapshot
            $table->string('whatsapp_number');     // snapshot
            $table->string('email');               // snapshot
            $table->text('detail_kebutuhan');      // detail permintaan / masalah utama
            $table->text('alamat')->nullable();                // alamat / lokasi
            $table->json('custom_fields')->nullable();   // field khusus per layanan (bisa kosong)
            $table->enum('status', ['pending','deal','canceled','completed'])->default('pending');
            $table->unsignedBigInteger('harga_fix')->nullable();      // diisi admin setelah deal
            $table->date('tanggal_pelaksanaan')->nullable();          // diisi admin setelah deal
            $table->timestamps();

            $table->index('layanan_id');
            $table->index('status');
            $table->index('order_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
