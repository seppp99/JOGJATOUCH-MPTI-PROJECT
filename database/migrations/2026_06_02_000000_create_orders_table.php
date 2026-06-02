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
            $table->string('service_slug');
            $table->string('package_selected');
            $table->string('nama_perusahaan');
            $table->string('no_whatsapp');
            $table->string('email_kerja');
            $table->string('jumlah_karyawan')->nullable();
            $table->string('jumlah_lokasi')->nullable();
            $table->string('perangkat_utama')->nullable();
            $table->text('masalah_utama')->nullable();
            $table->text('alamat_lokasi')->nullable();
            $table->json('custom_fields')->nullable(); // For custom/dynamic fields per service
            $table->string('status')->default('pending'); // pending, active, completed, cancelled
            $table->timestamps();
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
